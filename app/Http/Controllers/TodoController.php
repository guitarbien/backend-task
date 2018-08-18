<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Todo::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $todo = Todo::create($request->all());

        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo $todo
     * @return JsonResponse
     */
    public function show(Todo $todo): JsonResponse
    {
        return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Todo $todo
     * @return JsonResponse
     */
    public function update(Request $request, Todo $todo): JsonResponse
    {
        $todo->setAttribute('title', $request->get('title'));
        $todo->setAttribute('content', $request->get('content'));
        $todo->setAttribute('attachment', $request->get('attachment'));
        $todo->save();

        return response()->json($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo $todo
     * @return JsonResponse
     */
    public function delete(Todo $todo): JsonResponse
    {
        try {
            $todo->delete();
        }
        catch (\Exception $e) {
            return response()->json(null, 500);
        }

        return response()->json(null, 204);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteBatch(Request $request): JsonResponse
    {
        $ids = Collection::wrap($request->get('todos'))->pluck('id')->toArray();

        Todo::destroy($ids);

        return response()->json(null, 204);
    }
}
