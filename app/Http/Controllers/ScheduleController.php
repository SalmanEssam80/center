<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $schedules = Schedule::query();
        if ($request->has('search')) {
            $schedules->whereHas('course',function($q) use($request){
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        return view('schedules.index', ['schedules' => $schedules->orderBy('created_at', 'desc')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'course_id' => 'required',
            'class_room_id' => 'required',
            'user_id' => 'required',
        ]);
        Schedule::create($request->except('_token'));
        return redirect()->route('schedules.index')->with('added', 'New schedule Added');
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
        $schedule = Schedule::findOrFail($id);
        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'course_id' => 'required',
            'class_room_id' => 'required',
            'user_id' => 'required',
        ]);
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->except('_token'));
        return redirect()->route('schedules.index')->with('added', 'schedules edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Schedule::destroy($id);
        return back();
    }
}
