<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Experience; // Import the Experience model
use App\Http\Resources\ExperienceResource; // Import the ExperienceResource
use App\Helpers\ApiResponseHelper;



class AddExperienceApiController extends Controller
{
    /**
     * Add an experience for the authenticated user.
     */

     public function index(Request $request)
     {
         // Check if a specific student_id is provided
         if ($request->has('student_id')) {
             $experiences = Experience::where('student_id', $request->student_id)->get();
         } else {
             $experiences = Experience::all();
         }
 
        //  return ExperienceResource::collection($experiences);
         return ApiResponseHelper::success($experiences);

     }
 
     /**
      * Get a specific experience by ID.
      */
     public function show($id)
     {
         $experience = Experience::findOrFail($id);
         return new ExperienceResource($experience);
     }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'experience_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        // Get the authenticated student
        $student = Auth::guard('sanctum')->user();

        // Add the experience
        $experience = $student->experiences()->create($validated);

        return response()->json($experience, 201);
    }
}
