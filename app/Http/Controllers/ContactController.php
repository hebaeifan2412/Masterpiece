<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'subject' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Mail::raw($validated['message'], function ($message) use ($validated) {
        //     $message->to('hebaeifan24@gmail.com')
        //             ->subject($validated['subject'])
        //             ->from($validated['email'], $validated['first_name'] . ' ' . $validated['last_name']);
        // });
        Mail::raw('This is a test message', function ($message) {
    $message->to('hello@example.com')
            ->subject('Test Mail from Laravel');
});


        return back()->with('success', 'Message sent successfully!');
    }
}
