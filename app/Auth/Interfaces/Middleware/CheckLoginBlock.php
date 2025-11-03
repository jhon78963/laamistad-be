<?php

declare(strict_types=1);

namespace App\Auth\Interfaces\Middleware;

use App\Auth\Infrastructure\Models\LoginBlock;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class CheckLoginBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $email = $request->input('email');

        $blocked = LoginBlock::where('ip', $ip)
            ->where('email', $email)
            ->where('blocked_until', '>', Carbon::now())
            ->first();

        if ($blocked) {
            $blockedUntil = Carbon::parse($blocked->blocked_until);
            $now = Carbon::now();

            $diff = $now->diff($blockedUntil);

            $timeLeft = '';
            if ($diff->h > 0) {
                $timeLeft .= $diff->h . ' hora' . ($diff->h > 1 ? 's ' : ' ');
            }
            if ($diff->i > 0) {
                $timeLeft .= $diff->i . ' minuto' . ($diff->i > 1 ? 's' : '');
            }

            return response()->json([
                'message' => "Has superado el número máximo de intentos. Intenta nuevamente después de $timeLeft.",
            ], 429);

        }

        return $next($request);
    }
}
