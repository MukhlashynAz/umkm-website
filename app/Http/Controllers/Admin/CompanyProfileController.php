<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $company = CompanyProfile::first();

        return view('admin.company-profile.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $company = CompanyProfile::first();

        if (!$company) {
            $company = new CompanyProfile();
        }

        $company->company_name = $request->company_name;
        $company->description = $request->description;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->instagram = $request->instagram;

        if ($request->hasFile('logo')) {

            // Hapus logo lama jika ada
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            // Simpan logo baru
            $company->logo = $request->file('logo')
                ->store('company', 'public');
        }

        $company->save();

        return redirect()
            ->route('admin.company-profile.edit')
            ->with('success', 'Company Profile berhasil diperbarui.');
    }
}