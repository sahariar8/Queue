<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Jobs\SendOtpJob;
use App\Mail\AdminReportMail;
use App\Mail\RegistrationSuccessMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration');
    }
    public function store(Request $request)
    {
      
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
           
        ]);

        

        // Create a new user
        DB::table('users')->insert($request->except('_token'));
        // $latestUsers = User::latest()->take(5)->get();
        // Mail::to($request->email)->send(new RegistrationSuccessMail($request));
        // Mail::to('admin@gmail.com')->send(new AdminReportMail($latestUsers));

        for ($i = 0; $i < 10; $i++) {
            
            dispatch(new SendMailJob((object)$request->all()));
        }

        // Redirect to a success page or login page
        return redirect()->back()->with('success', 'Registration successful! Please log in.');
    }

    public function sendOtp(){
        
        dispatch(new SendOtpJob())->onQueue('high');
        return redirect()->back()->with('success', 'OTP Send successfully');

    }
}
