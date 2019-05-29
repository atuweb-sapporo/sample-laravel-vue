<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as Auth;

/**
 * Class AuthenticateToken
 * @package App\Http\Middleware
 */
class AuthenticateToken
{
    /** @var Auth */
    protected $auth;


    /**
     * Create a new middleware instance.
     *
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (false === $this->auth->guard('spa')->check()) {
            abort(401);
        }
        return $next($request);
    }
}
