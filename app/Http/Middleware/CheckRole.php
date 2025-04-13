<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Enhanced debug information
        Log::info('CheckRole middleware called', [
            'user' => $request->user() ? $request->user()->id : 'not authenticated',
            'required_roles' => $roles,
            'user_role' => $request->user() ? $request->user()->role : 'none',
            'path' => $request->path(),
            'method' => $request->method()
        ]);

        // Check if the user is authenticated
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Check if user has one of the required roles
        if (in_array($request->user()->role, $roles)) {
            // Check if user is active (for consultants)
            if ($request->user()->role === 'consultant' && $request->user()->status !== 'active') {
                auth()->logout();
                return redirect()->route('login')
                    ->withErrors(['message' => 'Votre compte consultant est en attente d\'approbation.']);
            }
            
            return $next($request);
        }

        // If user tries to access a different role's area, redirect to their appropriate dashboard
        if ($request->user()->role === 'consultant') {
            return redirect()->route('consultant.dashboard')
                ->with('error', 'Vous n\'avez pas accès à cette section.');
        } elseif ($request->user()->role === 'user') {
            return redirect()->route('dashboard')
                ->with('error', 'Vous n\'avez pas accès à cette section.');
        } elseif ($request->user()->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Vous n\'avez pas accès à cette section.');
        }

        // Return 403 Forbidden response as fallback
        abort(403, 'Accès non autorisé. Vous n\'avez pas les permissions nécessaires pour accéder à cette page.');
    }
}
