<?php

namespace App\Http\Controllers;

use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use UnexpectedValueException;

/**
 * Class TokenController
 * @package App\Http\Controllers
 */
class TokenController extends Controller
{
    /** @var string */
    private $secret;

    public function __construct()
    {
        $this->secret = env('JWT_SECRET', 'SOME_KEY');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        // todo : implement auth logic here if you want

        try {
            $jwt     = $request->header('token');
            $decoded = JWT::decode($jwt, $this->secret, ['HS256']);
        } catch (SignatureInvalidException | ExpiredException $e) {
            return response()->json(null, 401);
        } catch (UnexpectedValueException | BeforeValidException $e) {
            return response()->json(null, 500);
        }

        return response()->json($decoded, 200);
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $token = ["id" => 5566];
        array_merge($token, $this->getExpiredTime());

        $jwt = JWT::encode($token, $this->secret);

        return $this->withToken($jwt);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $jwt     = $request->header('token');
            $decoded = (array)JWT::decode($jwt, $this->secret, ['HS256']);

            array_merge($decoded, $this->getExpiredTime());
            $jwt = JWT::encode($decoded, $this->secret);
        } catch (SignatureInvalidException | ExpiredException $e) {
            return response()->json(null, 401);
        } catch (UnexpectedValueException | BeforeValidException $e) {
            return response()->json(null, 500);
        }

        return $this->withToken($jwt);
    }

    /**
     * @return array
     */
    private function getExpiredTime(): array
    {
        return ["exp" => time() + env('JWT_TTL', 60)];
    }

    /**
     * @param string $token
     * @return JsonResponse
     */
    private function withToken(string $token): JsonResponse
    {
        return response()->json(null)->header('token', $token);
    }
}
