<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyValidationRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10)->through(fn($item) => [
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'logo' => $item->logo,
            'website' => $item->website,
        ]);

        return Inertia::render('Companies/CompanyIndex',
            [
                'companies' => $companies,
                'title' => 'All Companies'
            ]
        );
    }

    public function create(): Response
    {
        return Inertia::render('Companies/CompanyCreate',[
            'title' => 'Create Company'
        ]);
    }

    public function store(CompanyValidationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        //If logo is uploaded
        $files = $request->files;
        $fileName = null;
        if($files->count() == 1){
            $logo = $request->file('logo');
            $fileName = time().'.'.$logo->extension();
            $logo->move(public_path('uploads'), $fileName);
        }

        Company::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'logo' => $fileName,
            'website' => $validated['website'],
        ]);

        return to_route('companies.index');
    }

    public function show(Company $company)
    {
        //
    }

    public function edit(Company $company): Response
    {
        return Inertia::render('Companies/CompanyEdit', [
            'company' => $company,
            'title' => 'Edit '.ucwords($company->name)
        ]);
    }

    public function update(CompanyValidationRequest $request, Company $company): RedirectResponse
    {
        $validated = $request->validated();

        //If logo is uploaded
        $files = $request->files;
        $fileName = null;
        if($files->count() == 1){
            $logo = $request->file('logo');
            $fileName = time().'.'.$logo->extension();
            $logo->move(public_path('uploads'), $fileName);
        }

        $company->name = $validated['name'];
        $company->email = $validated['email'];
        $company->logo = $fileName;
        $company->website = $validated['website'];
        $company->save();

        return to_route('companies.index');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();
        return to_route('companies.index');
    }
}
