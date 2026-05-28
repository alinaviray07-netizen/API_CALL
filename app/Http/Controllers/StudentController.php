<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // GET /api/students
    public function index()
    {
        return response()->json([
            'message' => 'Students fetched successfully',
            'data' => Student::all()
        ], 200);
    }

    // GET /api/students/{id}
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Student fetched successfully',
            'data' => $student
        ], 200);
    }

    // POST /api/students
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'course' => 'required|string',
        ]);

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }

    // PUT /api/students/{id}
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $id,
            'course' => 'required|string',
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student
        ], 200);
    }

    // PATCH /api/students/{id}
    public function patch(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:students,email,' . $id,
            'course' => 'sometimes|string',
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Student partially updated successfully',
            'data' => $student
        ], 200);
    }

    // DELETE /api/students/{id}
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ], 200);
    }

    // DELETE /api/students
    public function destroyAll()
    {
        Student::truncate();

        return response()->json([
            'message' => 'All students deleted successfully'
        ], 200);
    }
}