<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'needs' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $contact = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => 'Contact Form Submission',
            'message' => $request->needs,
        ]);

        // Send email notification
        try {
            Mail::send('emails.contact-notification', [
                'contactName' => $request->name,
                'contactEmail' => $request->email,
                'contactPhone' => $request->phone,
                'contactMessage' => $request->needs,
            ], function ($message) use ($request) {
                $message->to(config('mail.from.address'))
                        ->subject('Pesan Baru dari Form Kontak: ' . $request->name);
                $message->replyTo($request->email, $request->name);
            });

            // Send auto-reply to customer
            Mail::send('emails.contact-autoreply', [
                'customerName' => $request->name,
            ], function ($message) use ($request) {
                $message->to($request->email, $request->name)
                        ->subject('Terima kasih telah menghubungi NoFileExistsHere.');
            });
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send contact email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully!',
            'data' => $contact
        ], 201);
    }
}
