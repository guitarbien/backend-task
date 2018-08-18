<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use UnexpectedValueException;

/**
 * Class VerifyToken
 * @package App\Http\Middleware
 */
class VerifyToken
{
    /** @var string */
    private $secret;

    public function __construct()
    {
        $this->secret = env('JWT_SECRET', 'SOME_KEY');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $jwt     = $request->header('token');
            JWT::decode($jwt, $this->secret, ['HS256']);
        } catch (SignatureInvalidException | ExpiredException $e) {
            return response()->json(null, 401);
        } catch (UnexpectedValueException | BeforeValidException $e) {
            return response()->json(null, 500);
        }

        return $next($request);
    }
}
