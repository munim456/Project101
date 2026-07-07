<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class BookingController extends Controller
{
    public function show()
    {
        return view('pages.booking', [
            'healthengineUrl' => Setting::get('healthengine_url'),
            'clinicPhone' => Setting::get('clinic_phone'),
        ]);
    }
}
