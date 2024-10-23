<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeesController extends Controller
{

    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }


    public function create()
    {
        return view('admin.employees.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'job' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'bio' => 'required|string',
            'picture_path' => 'required|string',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'instagram' => 'required|url',
            'linkedin' => 'required|url',
        ]);

        $employeeData = $request->all();


        if (isset($employeeData['picture_path']) && !empty($employeeData['picture_path'])) {
            if (filter_var($employeeData['picture_path'], FILTER_VALIDATE_URL)) {

                $employeeData['picture_path'] = $employeeData['picture_path'];
            } else {

                $employeeData['picture_path'] = $employeeData['picture_path'];
            }
        }

        Employee::create($employeeData);

        session()->flash('success', 'Employee created successfully!');

        return redirect()->route('admin.employees.index');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.edit', compact('employee'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'job' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'bio' => 'required|string',
            'picture_path' => 'required|string',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'instagram' => 'required|url',
            'linkedin' => 'required|url',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        session()->flash('success', 'Employee updated successfully!');
        return redirect()->route('admin.employees.index');
    }


    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(null, 204);
    }
}
