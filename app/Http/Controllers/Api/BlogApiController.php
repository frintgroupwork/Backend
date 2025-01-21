<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Resources\BlogResource;

class BlogApiController extends Controller
{
    /**
     * Display a listing of the blogs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve blogs with 'blogType' relationship and eager load 'favoritedBy' for the current user
        $blogs = Blog::with('blogType')->get();
        
        // Return the collection of blogs with the favorited_by_current_user attribute appended
        return BlogResource::collection($blogs);
    }

    /**
     * Store a newly created blog in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'blog_type_id' => 'required|exists:blog_type,id',
            'source' => 'nullable|url',
        ]);

        // Create the blog
        $blog = Blog::create($validated);

        return response()->json($blog, 201);
    }

    /**
     * Display the specified blog.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json($blog);
    }

    /**
     * Update the specified blog in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'blog_type_id' => 'required|exists:blog_type,id',
            'source' => 'nullable|url',
        ]);

        // Update the blog with validated data
        $blog->update($validated);

        return response()->json($blog);
    }

    /**
     * Remove the specified blog from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json(null, 204);
    }
}
