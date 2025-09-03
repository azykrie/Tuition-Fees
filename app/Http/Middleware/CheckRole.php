<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard.index');
            case 'student':
                return redirect()->route('student.dashboard.index');
            default:
                abort(403, 'Unauthorized');
        }
    }
}
