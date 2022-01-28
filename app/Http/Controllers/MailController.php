<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $email = "koswara0790asep@gmail.com";
        $data = [
            'subject' => $request->input('subject'),
            'message' => $request->input('message')
        ];

        Mail::to($email)->send(new PostMail($data));
        return redirect()->back()->with('success', 'Email has been sent successfully. Please check your email!');
    }
}
