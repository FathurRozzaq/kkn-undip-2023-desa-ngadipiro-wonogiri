<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;

class MailController extends Controller
{
    public function sendEmailForm()
    {
        return view('send_email');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'subject' => $request->subject,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::to($data['email'])->send(new SendMail($data['subject'], $data['message']));

        return redirect()->back()->with('success', 'Email berhasil dikirim!');
    }
}
?>