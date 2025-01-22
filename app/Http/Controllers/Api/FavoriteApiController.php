<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Student;
use App\Helpers\ApiResponseHelper;




class FavoriteApiController extends Controller
{
   
    public function toggleFavorite(Request $request)
    {
        $student = auth()->user(); // Assuming authentication is implemented
        $blogId = $request->input('blog_id');

        $blog = Blog::find($blogId);
        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        // Check if the blog is already favorited
        if ($student->favorites()->where('blog_id', $blogId)->exists()) {
            // If it exists, remove it (unfavorite)
            $student->favorites()->detach($blogId);
            return response()->json(['message' => 'Blog removed from favorites'], 200);
        } else {
            // If it doesn't exist, add it (favorite)
            $student->favorites()->attach($blogId);
            return response()->json(['message' => 'Blog added to favorites'], 200);
        }
    }

    public function getFavorites(Request $request)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Get the user's favorites (without any unnecessary relationships)
        $favorites = $user->favorites()->get();

        // return response()->json([
        //     'message' => 'Favorites retrieved successfully',
        //     'favorites' => $favorites,
        // ]);

        return ApiResponseHelper::success($favorites);

    }


}
