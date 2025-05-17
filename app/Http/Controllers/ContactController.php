<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    

  public function submit(Request $request)
{
    $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email',
        'subject' => 'required|string',
        'message' => 'required|string',
    ]);

    $fullName = $request->first_name . ' ' . $request->last_name;

    Mail::raw($request->message, function ($message) use ($request, $fullName) {
        $message->to('numaschool25@gmail.com')
            ->subject($request->subject)
            ->replyTo($request->email)
            ->from($request->email, $fullName);
    });

    return back()->with('success', 'Your message has been sent successfully!');
}
}
