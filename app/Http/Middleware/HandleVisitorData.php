<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Models\IftaCalc\Visitor as Visitor;
use App\Models\IftaCalc\Visit as Visit;
use App\Events\NewVisit;
 

class HandleVisitorData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $userId =  auth()->check() ? auth()->id() : null;

        
        $ip = $request->ip();
        $referrer = $request->headers->get('referer');
        if($request->ajax()){
            //dont track internal
            $referrer = null;
        }

        
        $aff = $request->query('aff');

        $meta = [
            'ip'         => $ip,
            'aff'        => $aff,
            'user_agent' => $request->userAgent(),
            'utm_source'   => $request->query('utm_source'),
            'utm_medium'   => $request->query('utm_medium'),
            'utm_campaign' => $request->query('utm_campaign'),
            'utm_term'     => $request->query('utm_term'),
            'utm_content'  => $request->query('utm_content'),
            'fbclid'=> $request->query('fbclid'),
            'gclid'=> $request->query('gclid'),
            'date'=>date('Y-m-d')
        ];




        if (Cookie::has('ic_settings_id')) {
            
            $uuid = Cookie::get('ic_settings_id');
        
        }else{
            $uuid = (string) Str::uuid();
            Cookie::queue('ic_settings_id', $uuid, 60 * 24 * 365);
        }

        $visitor = Visitor::where([
            'visitor_id' => $uuid,
        ])->select(['id','visitor_id', 'user_id'])->first();

        try{    

            if(!$visitor){
                $visitor = Visitor::create([
                    'visitor_id' => $uuid,
                    'user_id'=>$userId,             
                    'meta'=>$meta
                ]);
                
            }else{
                if(empty($visitor->user_id) && !empty($userId)){
                    $visitor->user_id =$userId;
                    $visitor->save();
                }
            }

            $meta['visitor_uuid'] = $uuid;
            $visitId = md5(serialize($meta));
            $meta['referrer'] =  $referrer;


            $visit = Visit::find($visitId);

            if(!$visit){
                $visit = Visit::create([
                    'id'=>$visitId,
                    'visitor_id'=>$visitor->id,
                    'meta'=>$meta

                ]);
                event(new NewVisit($visit));
            }

        }catch(\Exception $e){

            Log::debug("[HandleVisitorData] Error  ".$e->getMessage(), [
                'visitor_id' => $uuid,
                'user_id'=>$userId,             
                'meta'=>$meta
            ]);

        }



        return $next($request);
    }
}
