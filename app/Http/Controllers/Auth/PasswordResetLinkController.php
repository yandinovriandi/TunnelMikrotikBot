<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendPasswordResetLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        dispatch(new SendPasswordResetLink($request->only('email')));
        $statusError = 'Kami tidak menemukan email yang anda masukan di system kami.';
        $status = 'Kami telah mengirim link untuk reset password ke email anda.';
        return Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($statusError)]);
    }
}
