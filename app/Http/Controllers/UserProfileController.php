<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.profile.show', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.profile.edit', [
            'save_route' => route('profile.update', $id),
            'str_mode' => 'Kemas Kini',
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required',
            'ic_no'   => 'required|unique:users,ic_no,' . $id,
            'email'      => 'required|email|unique:users,email,' . $id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required',
            'phone_no' => 'nullable|string',
        ], [
            'name.required'     => 'Sila isi nama pengguna',
            'ic_no.required' => 'Sila isi no. pekerja pengguna',
            'ic_no.unique' => 'No. pekerja telah wujud',
            'email.required'    => 'Sila isi emel pengguna',
            'email.unique'    => 'Emel telah wujud',
            'position.required' => 'Sila isi jawatan pengguna',
        ]);

        $user = User::findOrFail($id);

        // Update the user's basic information
        $user->fill($request->only('name', 'ic_no', 'email', 'position', 'phone_no'));

        // Handle profile image update or removal
        if ($request->hasFile('profile_image')) {
            // Store the new file and get its path
            $path = $request->file('profile_image')->store("users/{$id}/profile_images", 'public');
            $user->profile_image = $path;
        } elseif ($request->input('remove_photo') == '1') {
            // If photo is removed, set the default image path
            $user->profile_image = '';  // Set default image
        }

        $user->save();

        return redirect()->route('profile.show', $id) // Corrected route name
            ->with('success', 'Maklumat berjaya dikemaskini');
    }

    public function changePasswordForm($id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.profile.change-password', [
            'user' => $user,
        ]);
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Kata laluan semasa tidak sah.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.show', $id)
            ->with('success', 'Kata laluan berjaya dikemaskini.');
    }
}
