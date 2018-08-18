<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $payload = JWT::decode($request->header('token'), $this->secret, ['HS256']);

        return response()->json(["TTL" => $payload->exp - time()], 200);
    }

    /**
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $payload = $this->refreshExpiredTime(["id" => 5566]);

        $jwt = JWT::encode($payload, $this->secret);

        return $this->withToken($jwt);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $jwt = $request->header('token');

        $decoded = (array)JWT::decode($jwt, $this->secret, ['HS256']);
        $payload = $this->refreshExpiredTime($decoded);

        $jwt = JWT::encode($payload, $this->secret);

        return $this->withToken($jwt);
    }

    /**
     * @param array $payload
     * @return array
     */
    private function refreshExpiredTime(array $payload): array
    {
        return array_merge($payload, ["exp" => time() + env('JWT_TTL', 60)]);
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
