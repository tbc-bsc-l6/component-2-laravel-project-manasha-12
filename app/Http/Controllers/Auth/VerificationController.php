<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified
     */
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('student')->hasVerifiedEmail()) {
            return redirect()->route('student.dashboard')
                ->with('success', 'Your email is already verified!');
        }

        if ($request->user('student')->markEmailAsVerified()) {
            event(new Verified($request->user('student')));
        }

        return redirect()->route('student.dashboard')
            ->with('success', 'Email verified successfully! Welcome to your dashboard.');
    }

    /**
     * Resend the email verification notification
     */
    public function resend(Request $request): RedirectResponse
    {
        if ($request->user('student')->hasVerifiedEmail()) {
            return redirect()->route('student.dashboard');
        }

        $request->user('student')->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    }
}