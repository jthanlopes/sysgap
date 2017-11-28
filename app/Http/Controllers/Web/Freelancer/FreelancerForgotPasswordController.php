<?php

namespace App\Http\Controllers\Web\Freelancer;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Password;
use Auth;

class FreelancerForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:freelancer');
    }

    protected function broker() {
        return Password::broker('freelas');
    }

    public function showLinkRequestForm() {
        return view('site.email-freelancer');
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => 'E-mail não encontrado!']
        );
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', 'Link para redefinir senha enviado!');
    }
}
