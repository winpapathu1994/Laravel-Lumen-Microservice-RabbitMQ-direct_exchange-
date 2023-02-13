<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use App\Constants\ErrorConstant;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
class AuthenticateAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowedAccess = config('constant.allowed_access_secrets');

        // Check access key exist or not
        if (empty($request->header('accessKey'))) {
            throw new UnauthorizedHttpException('Basic', ErrorConstant::MISSING_AUTH_FIELD);
        }
        return $next($request);
        if (base64_decode($request->header('accessKey')) === $allowedAccess) {
            return $next($request);
        }else{
            throw new UnauthorizedHttpException('Basic', ErrorConstant::INVALID_AUTHORIZATION);
        }
    }
}
