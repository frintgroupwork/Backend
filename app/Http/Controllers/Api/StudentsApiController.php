<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\ExperienceResource; // Import the ExperienceResource
use App\Http\Resources\StudentResource; // Import the ExperienceResource
use App\Helpers\ApiResponseHelper;


class StudentsApiController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $students = Student::with('experiences')->get(); // Eager load experiences
        // return StudentResource::collection($students);
        return ApiResponseHelper::success($students);

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
            'full_name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'nullable|in:male,female,rather_not_to_say',
            'email' => 'required|email|unique:students,email',
            'address' => 'nullable|string|max:255',
            'phonenumber' => 'nullable|string|max:20',

            'university' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',

            'experience_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
        ]);

        $student = Student::create($validated);

        return response()->json($student, 201);
    }

    /**
     * Display the specified student.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $student = Student::with('experiences')->findOrFail($id);  // Eager load experiences
        return new StudentResource($student);
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
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'birthday' => 'sometimes|date',
            'gender' => 'nullable|in:male,female,rather_not_to_say',
            'email' => 'sometimes|email|unique:students,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phonenumber' => 'nullable|string|max:20',

            'university' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:255',
            'major' => 'nullable|string|max:255',

            'experience_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
        ]);

        $student->update($validated);

        return response()->json($student);
    }

    /**
     * Remove the specified student from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(null, 204);
    }
}
