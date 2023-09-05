<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::query();
        if ($request->has('search')) {
            $employees->where('job_title', 'like', '%' . $request->search . '%')->orWhere('hire_date', 'like', '%' . $request->search . '%');
        }
        return view('employees.index', ['employees' =>  $employees->orderBy('created_at', 'desc')->orderBy('salary')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'job_title' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'required'
        ]);
        Employee::create($request->except('_token'));
        return redirect()->route('employees.index')->with('added', 'New employee added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required',
            'job_title' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'required'
        ]);
        $employee = Employee::findOrFail($id);
        $employee->update($request->except('_token'));
        return redirect()->route('employees.index')->with('added', 'employee updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Employee::destroy($id);
            return redirect()->route('employees.index')->with('added', 'employee deleted');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->route('employees.index');
        }
    }
}
