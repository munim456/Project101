<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormReceived;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $contactMessage = ContactMessage::create($validated);

        if ($clinicEmail = Setting::get('clinic_email')) {
            try {
                Mail::to($clinicEmail)->send(new ContactFormReceived($contactMessage));
            } catch (Throwable $e) {
                Log::error('Failed to send contact form notification email: '.$e->getMessage());
            }
        }

        return redirect()->route('contact')->with('status', 'Thanks — your message has been sent. We\'ll be in touch soon.');
    }
}
