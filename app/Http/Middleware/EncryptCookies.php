<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Cookie\CookieValuePrefix;
class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
        'ic_settings_id'
    ];


    public function handle($request, Closure $next)
    {


        return parent::handle($request, $next);
    }

    protected function encrypt111(Response $response)
    {


        foreach ($response->headers->getCookies() as $cookie) {
            dump([$cookie->getName(), $this->isDisabled($cookie->getName())]);

            if ($this->isDisabled($cookie->getName())) {
                continue;
            }

            $response->headers->setCookie($this->duplicate(
                $cookie,
                $this->encrypter->encrypt(
                    CookieValuePrefix::create($cookie->getName(), $this->encrypter->getKey()).$cookie->getValue(),
                    static::serialized($cookie->getName())
                )
            ));
        }

        return $response;
    }
}
