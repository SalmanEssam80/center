<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        $company = CompanyResource::collection(Company::all());
        return response()->json($company);
        } catch (Exception $e){
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ],401);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'owner' => 'required',
            'tax_number' => 'required',
        ]);
        try {
            $company = Company::create($request->all());
            return response()->json([
                'status' => 'company added',
                'company' => new CompanyResource($company)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
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
            $company = Company::findOrFail($id);
            return response()->json([
                'status' => 'company returned',
                'company' => new CompanyResource($company)
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
            $company = Company::findOrFail($id);
            $company->update($request->all());
            return response()->json([
                'status' => 'company updated',
                'company' => new CompanyResource($company)
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
            Company::destroy($id);
            return response()->json([
                'status' => 'company deleted',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => $e->getMessage()
            ]);
        }
    }
}
