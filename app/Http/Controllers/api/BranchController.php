<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $branch = BranchResource::collection(Branch::all());
            return response()->json($branch);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'company_id' => 'required',
        ]);
        try {
            $branch = Branch::create($request->all());
            return response()->json([
                'status' => 'company added',
                'message' => new  BranchResource($branch)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $branch = Branch::findOrFail($id);
            return response()->json([
                'status' => 'company return',
                'message' => new  BranchResource($branch)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $branch = Branch::findOrFail($id);
            $branch->update($request->all());
            return response()->json([
                'status' => 'company updated',
                'message' => new  BranchResource($branch)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $branch = Branch::findOrFail($id);
            if ($branch) {
                $branch->delete();
                return response()->json([
                    'status' => 'company deleted'
                ]);
            }
            return response()->json([
                'status' => 'company deleted'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => $e->getMessage()
            ]);
        }
    }
}
