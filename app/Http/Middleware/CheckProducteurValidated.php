<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProducteurValidated
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!$user || !$user->is_validated) {
            return redirect()->route('producteur.en.attente')
                ->with('error', 'Votre compte producteur doit être validé par un administrateur.');
        }
        return $next($request);
    }
}