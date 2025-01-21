<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\BlogType;
use Illuminate\Http\Request;

class BlogTypeApiController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $blogtypes = BlogType::all();
        return response()->json($blogtypes);
    }

    /**
     * Store a newly created student in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type_name' => 'string|max:255',            
        ]);

        $blogtypes = BlogType::create($validated);

        return response()->json($blogtypes, 201);
    }

    /**
     * Display the specified student.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $blogtypes = BlogType::findOrFail($id);
        return response()->json($blogtypes);
    }

    /**
     * Update the specified student in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $blogtypes = BlogType::findOrFail($id);

        $validated = $request->validate([
            'type_name' => 'string|max:255',
           
        ]);

        $blogtypes->update($validated);

        return response()->json($blogtypes);
    }

    /**
     * Remove the specified student from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $blogtypes = BlogType::findOrFail($id);
        $blogtypes->delete();

        return response()->json(null, 204);
    }
}

