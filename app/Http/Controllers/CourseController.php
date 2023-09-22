<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::query();
        if ($request->has('search')) {
            $courses->where('name', 'like', '%' . $request->search . '%');
        }
        return view('courses.index', ['courses' => $courses->orderBy('created_at', 'desc')->orderBy('name')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'hours' => 'required|numeric',
            'price' => 'required|numeric',
            'vendor_id' => 'required',
            'main_category_id' => 'required',
            'sub_category_id' => 'nullable',
            'user_id' => 'required',
        ]);
        $course = new Course();
        $course->name = $request->name;
        $course->hours = $request->hours;
        $course->price = $request->price;
        $course->vendor_id = $request->vendor_id;
        $course->category_id  = ($request->sub_category_id)  ? $request->sub_category_id : $request->main_category_id;
        $course->user_id = $request->user_id;
        $course->save();
        return redirect()->route('courses.index')->with('added', 'New Course Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'hours' => 'required|numeric',
            'price' => 'required|numeric',
            'vendor_id' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);
        $course = Course::findOrFail($id);
        $course->update($request->except('_token'));
        return redirect()->route('courses.index')->with('added', 'course updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::destroy($id);
        return back();
    }
}
