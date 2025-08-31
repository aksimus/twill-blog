<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle AJAX contact form submission
     */
    public function submit(ContactFormRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            
            // Log the contact form submission
            Log::info('Contact form submitted via AJAX', [
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? 'Not provided',
                'message_length' => strlen($validated['message']),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referer' => $request->headers->get('referer'),
            ]);
            
            // Simulate processing time (remove in production)
            // sleep(1);
            
            // Here you can add email sending logic
            // For now, we'll just log the submission
            
            // Example: Send email to admin
            // Mail::send('emails.contact', $validated, function ($message) use ($validated) {
            //     $message->to(config('mail.admin_email', 'admin@example.com'))
            //             ->subject('New Contact Form Submission')
            //             ->replyTo($validated['email']);
            // });
            
            // Example: Send confirmation email to user
            // Mail::send('emails.contact-confirmation', $validated, function ($message) use ($validated) {
            //     $message->to($validated['email'])
            //             ->subject('Thank you for contacting us');
            // });
            
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully.',
                'data' => [
                    'email' => $validated['email'],
                    'submitted_at' => now()->toISOString(),
                ]
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Please check your input and try again.',
                'errors' => $e->errors(),
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'email' => $request->input('email'),
                'request_data' => $request->except(['_token']),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'There was an error sending your message. Please try again later.',
            ], 500);
        }
    }
}
