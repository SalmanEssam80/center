<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $managers =  Manager::query();
        if ($request->has('search')) {
            $managers->where('name', 'like', '%' . $request->search . '%')->orWhere('mobile', 'like', '%' . $request->search . '%');
        }
        return view('managers.index', ['managers' => $managers->orderBy('created_at', 'desc')->orderBy('name')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('managers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'company_id' => 'required'
            ],
            [
                'company_id' => 'The company name field is required.'
            ]
        );
        Manager::create($request->except('_token'));
        return redirect()->route('managers.index')->with('added', 'New manager Added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $manager = Manager::findOrFail($id);
        return view('managers.edit', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'mobile' => 'required|numeric',
                'company_id' => 'required'
            ],
            [
                'company_id' => 'The company name field is required.'
            ]
        );
        $manager = Manager::findOrFail($id);
        $manager->update($request->except("_token"));
        return redirect()->route('managers.index')->with('added', 'manager updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Manager::destroy($id);
            return redirect()->route('managers.index')->with('added', 'manager delete');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->route('managers.index');
        }
    }
}
