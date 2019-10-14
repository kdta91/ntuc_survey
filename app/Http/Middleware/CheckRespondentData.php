<?php

namespace App\Http\Middleware;

use Closure;

class CheckRespondentData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request()->path() === 'survey/1') {
            if (!($request->session()->exists('respondent'))) {
                return redirect('respondent/create');
            }
        }

        if (request()->path() === 'survey/2') {
            if (!($request->session()->exists('answers'))) {
                return redirect('survey/1');
            }
        }

        if (request()->path() === 'free-gift') {
            if (!($request->session()->exists('respondent'))) {
                return redirect('/');
            } else if (!($request->session()->exists('answers'))) {
                return redirect('survey/1');
            }
        }

        return $next($request);
    }
}
