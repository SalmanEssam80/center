<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classRooms = ClassRoom::query();
        if ($request->has('search')) {
            $classRooms->where('name', 'like', '%' . $request->search . '%')->orWhere('capacity', 'like', '%' . $request->search . '%');
        }
        return view('ClassRooms.index', ['classRooms' => $classRooms->orderBy('created_at', 'desc')->orderBy('name')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ClassRooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'configration' => 'required',
            'capacity' => 'required|numeric',
            'branch_id' => 'required'
        ]);
        ClassRoom::create($request->except('_token'));
        return redirect()->route('classRooms.index')->with('added', 'New Class Room Add');
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
        $classroom = ClassRoom::findOrFail($id);
        return view('ClassRooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'configration' => 'required',
            'capacity' => 'required|numeric',
            'branch_id' => 'required'
        ]);
        $classroom = ClassRoom::findOrFail($id);
        $classroom->update($request->except('_token'));
        return redirect()->route('classRooms.index')->with('added', 'Class Room Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ClassRoom::destroy($id);
        return back();
    }
}
