<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
  public function handle(Request $request, Closure $next, ...$roles)
{
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    if (!in_array($user->role->value, $roles)) {
        abort(403, 'Akses ditolak.');
    }

    return $next($request);
}

}
