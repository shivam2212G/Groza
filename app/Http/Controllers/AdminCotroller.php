<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminCotroller extends Controller
{

    public function showReisterForm(){
        return view('admin.pages.register');
    }
    public function store(Request $request)
{
    // // Validate incoming data
    $request->validate([
        'shop_name'   => 'required|string|max:255',
        'email'       => 'required|email|unique:admins,email',
        'password'    => 'required|min:6',
        'shop_image'  => 'required|image',
        'location'    => 'required|string|max:255',
    ]);

    // Handle the image upload
    $imagePath = $request->file('shop_image')->store('shop_images', 'public');

    $admin = new Admin();
    $admin->shop_name  = $request->shop_name;
    $admin->email      = $request->email;
    $admin->password   = Hash::make($request->password); // Secure password
    $admin->owner_name = $request->owner_name;
    $admin->shop_image = $imagePath;
    $admin->location   = $request->location;
    $admin->status     = $request->status;
    $admin->save();

    return redirect()->back()->with('success', 'Admin registered successfully!');
    }

    public function showLoginForm()
{
    return view('admin.pages.login');
}

public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $admin = Admin::where('email', $request->email)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        // Store admin ID in session
        session(['admin_id' => $admin->admin_id]);
        return redirect()->route('admins.dashboard');
    }

    return back()->with('error', 'Invalid credentials.');
}

public function dashboard()
{
    return view('admin.pages.index');
}

public function logout()
{
    session()->forget('admin_id');
    return redirect()->route('admins.login')->with('success', 'Logged out successfully.');
}

public function profile($id){
    $admin = Admin::find($id);
    return view('admin.pages.adminprofile', compact('admin'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:active,inactive',
    ]);

    $admin = Admin::findOrFail($id);
    $admin->status = $request->status;
    $admin->save();

    return redirect()->back()->with('success', 'Status updated successfully.');
}



public function editProfile($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.pages.editadminprofile', compact('admin'));
    }

    public function updateProfile(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,'.$admin->admin_id.',admin_id',
            'owner_name' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'shop_image' => 'nullable|image',
            'password' => 'nullable|min:6',
        ]);

        // Handle image update
        if ($request->hasFile('shop_image')) {
            // Delete old image if exists
            if ($admin->shop_image && Storage::disk('public')->exists($admin->shop_image)) {
                Storage::disk('public')->delete($admin->shop_image);
            }
            $admin->shop_image = $request->file('shop_image')->store('shop_images', 'public');
        }

        // Update password if provided
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->shop_name = $request->shop_name;
        $admin->email = $request->email;
        $admin->owner_name = $request->owner_name;
        $admin->location = $request->location;
        $admin->save();

        return redirect()->route('admin.profile', $admin->admin_id)
            ->with('success', 'Profile updated successfully!');
    }

}
