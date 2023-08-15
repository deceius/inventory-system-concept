<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    protected function authenticate($request, array $guards)
    {
        parent::authenticate($request, $guards);

        // Got here? good! it means the user is session authenticated. now we should check if it authorize
        if (!$this->canLogin(auth()->user())) {
            auth()->logout();
            $this->unauthenticated($request, $guards);
        }
    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    private function canLogin(User $user) {
        return !$user->trashed();
    }
}
