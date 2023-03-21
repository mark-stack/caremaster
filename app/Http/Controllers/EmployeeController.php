<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeValidationRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmployeeController extends Controller
{
    public function index(): Response
    {
        $employees = Employee::paginate(10)->through(fn($item) => [
            'id' => $item->id,
            'first_name' => $item->first_name,
            'last_name' => $item->last_name,
        ]);

        return Inertia::render('Employees/EmployeeIndex',
            [
                'employees' => $employees,
                'employeesQty' => Employee::count(),
                'title' => 'All Employees'
            ]
        );
    }

    public function create(): Response
    {
        $companies = Company::all();

        return Inertia::render('Employees/EmployeeCreate',[
            'companies' => $companies,
            'title' => 'Create Employee'
        ]);
    }

    public function store(EmployeeValidationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Employee::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'company_id' => $validated['company_id'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        return to_route('employees.index');
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee): Response
    {
        $companies = Company::all();

        return Inertia::render('Employees/EmployeeEdit', [
            'employee' => $employee,
            'companies' => $companies,
            'title' => 'Edit '.ucwords($employee->first_name)
        ]);
    }

    public function update(EmployeeValidationRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        $employee->first_name = $validated['first_name'];
        $employee->last_name = $validated['last_name'];
        $employee->company_id = $validated['company_id'];
        $employee->email = $validated['email'];
        $employee->phone = $validated['phone'];
        $employee->save();

        return to_route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return to_route('employees.index');
    }
}
