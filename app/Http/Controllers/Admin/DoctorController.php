<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Support\ImageUploader;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('admin.doctors.index', [
            'doctors' => Doctor::orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.doctors.form', ['doctor' => new Doctor()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = ImageUploader::store($request->file('photo'), 'doctors');
        }

        Doctor::create($validated);

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor added.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.form', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            ImageUploader::delete($doctor->photo);
            $validated['photo'] = ImageUploader::store($request->file('photo'), 'doctors');
        }

        $doctor->update($validated);

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor updated.');
    }

    public function destroy(Doctor $doctor)
    {
        ImageUploader::delete($doctor->photo);
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor removed.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'qualifications' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:Available,On Leave,Not Accepting New Patients'],
            'bio' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'photo' => ['nullable', 'image', 'max:4096', 'mimes:jpg,jpeg,png,webp'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
