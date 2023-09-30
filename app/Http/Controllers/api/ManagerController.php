<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerResource;
use App\Models\Manager;
use Exception;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $manager = ManagerResource::collection(Manager::all()) ;
            return response()->json($manager);
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
            'mobile' => 'required|numeric',
            'company_id' => 'required',
        ]);
        try {
            $manager = Manager::create($request->all());
            return response()->json([
                'status' => 'manager added',
                'message' => new ManagerResource($manager)
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
            $manager = Manager::findOrFail($id);
            return response()->json([
                'status' =>'managr return',
                'message' => new ManagerResource($manager),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' =>'failed',
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
            'mobile' => 'required|numeric',
            'company_id' => 'required',
        ]);
        try {
            $manager = Manager::findOrFail($id);
            $manager->update($request->all());
            return response()->json([
                'status' =>'managr updated',
                'message' => new ManagerResource($manager),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' =>'failed',
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
            $manager = Manager::findOrFail($id);
            if ($manager) {
                $manager->delete();
                return response()->json([
                    'status' =>'managr deleted',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' =>'failed',
                'message' => $e->getMessage(),
            ],401);
        }
    }
}
