<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
