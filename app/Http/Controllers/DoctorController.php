<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        return view('pages.doctors', [
            'doctors' => Doctor::active()->get(),
        ]);
    }
}
