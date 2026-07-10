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

    public function show(Doctor $doctor)
    {
        abort_unless($doctor->is_active, 404);

        return view('pages.doctor-show', ['doctor' => $doctor]);
    }
}
