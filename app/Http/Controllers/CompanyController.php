<?php

namespace App\Http\Controllers;

use App\Mail\NewCompanyMail;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        // app()->setlocale('ar');
        $companies =  Company::query();
        if ($request->has('search')) {
            $companies->where('name', 'like', '%' . $request->search . '%')->orWhere('owner', 'like', '%' . $request->search . '%');
        }
        return view('companies.index', ['companies' => $companies->orderBy('created_at', 'desc')->orderBy('name')->paginate(10)]);
    }
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:50|min:3',
                'owner' => 'required',
                'tax_number' => 'nullable|numeric'
            ],
            [
                'tax_number.numeric' => 'الرقم الضريبي لازم يكون رقم'
            ]
        );
        // Company::create($request->except('_token'));
        $company = new Company();
        $company->name = $request->name;
        $company->owner = $request->owner;
        $company->tax_number = $request->tax_number;
        $company->save();
        Mail::to(auth()->user()->email,auth()->user()->name)->send(new NewCompanyMail($company));
        // session()->flash('added','New Company Added');
        return redirect()->route('company.index')->with('added', 'New Company Added');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    public function update($id ,Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:50|min:3',
                'owner' => 'required',
                'tax_number' => 'nullable|numeric'
            ],
            [
                'tax_number.numeric' => 'الرقم الضريبي لازم يكون رقم'
            ]
        );
        $company = Company::findOrFail($id);
        $company->update($request->except('_token'));
        return redirect()->route('company.index')->with('added', 'Company updated');
    }
    public function delete($id)
    {
        try {
            Company::destroy($id);
            return redirect()->route('company.index')->with('added', 'Company delete');
        } catch (Exception $e){
            Log::info($e->getMessage());
            return redirect()->route('company.index');
        }
    }
}
