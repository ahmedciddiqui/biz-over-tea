<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            return redirect('/app/admin/dashboard');
        }

        if ($user->hasRole('Investor')) {
            return redirect('/app/investor/dashboard');
        }

        return redirect('/app/dashboard');
    }
}
