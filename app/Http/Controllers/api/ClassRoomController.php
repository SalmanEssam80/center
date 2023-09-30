<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassRoomResource;
use App\Models\ClassRoom;
use Exception;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $classRoom = ClassRoomResource::collection(ClassRoom::all());
            return response()->json($classRoom);
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
            'name' => 'required',
            'configration' => 'required',
            'capacity' => 'required|numeric',
            'branch_id' => 'required',
        ]);
        try {
            $classRoom = ClassRoom::create($request->all());
            return response()->json([
                'status' => 'class room created',
                'message' => new ClassRoomResource($classRoom),
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
            $classRoom = ClassRoom::findOrFail($id);
            return response()->json([
                'status' => 'class room return',
                'message' => new ClassRoomResource($classRoom),
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
            'name' => 'required',
            'configration' => 'required',
            'capacity' => 'required|numeric',
            'branch_id' => 'required',
        ]);
        try {
            $classRoom = ClassRoom::findOrFail($id);
            $classRoom->update($request->all());
            return response()->json([
                'status' => 'class room updated',
                'message' => new ClassRoomResource($classRoom),
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
            $classRoom = ClassRoom::findOrFail($id);
            if($classRoom){
                $classRoom->delete();
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
