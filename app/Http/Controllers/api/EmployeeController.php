<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employee = EmployeeResource::collection(Employee::all());
            return response()->json($employee);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ],401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable',
            'job_title' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'nullable|date_format:y-m-d h:i:s a',
        ]);
        try {
            $employee = Employee::create($request->all());
            return response()->json([
                'status' => 'employee created',
                'message' => new EmployeeResource($employee),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ],401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return response()->json([
                'status' => 'employee return',
                'message' => new EmployeeResource($employee),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ],401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'nullable',
            'job_title' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'nullable|date_format:y-m-d h:i:s a',
        ]);
        try {
            $employee = Employee::findOrFail($id);
            $employee->update($request->all());
            return response()->json([
                'status' => 'employee updated',
                'message' => new EmployeeResource($employee),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            if($employee){
                $employee->delete();
                return response()->json([
                    'status' => 'class room deleted',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage(),
            ],401);
        }
    }
}
