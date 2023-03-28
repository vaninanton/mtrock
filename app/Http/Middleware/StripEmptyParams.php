<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StripEmptyParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $old_query = $request->query();

        $query = $old_query;
        foreach ($query as $key => $value) {
            // Если значения пустые - сносим!
            if ($value == '') {
                unset($query[$key]);

                continue;
            }
        }

        if ($old_query !== $query) {
            $path = url()->current().(!empty($query) ? '/?'.http_build_query($query) : '');

            return redirect($path, 301, []);
        }

        return $next($request);
    }
}
