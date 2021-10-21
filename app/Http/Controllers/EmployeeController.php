<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class EmployeeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Application|Factory|View
   */
  public function index()
  {
    $employees = Employee::with('company')->orderByDesc('created_at')->paginate(10);
    return view('employee.index', compact('employees'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Application|Factory|View
   */
  public function create()
  {
    $companies = Company::orderByDesc('created_at')->get();
    return view('employee.create', compact('companies'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param CreateEmployeeRequest $request
   * @return RedirectResponse
   */
  public function store(CreateEmployeeRequest $request): RedirectResponse
  {
    Employee::create($request->except('_token'));
    return redirect()->route('employees.index', app()->getLocale())->with(['successStore' => true]);
  }

  /**
   * Display the specified resource.
   *
   * @param Employee $employee
   * @return Response
   */
  public function show(Employee $employee)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Employee $employee
   * @return Application|Factory|View
   */
  public function edit($language, Employee $employee)
  {
    $companies = Company::orderByDesc('created_at')->get();
    return view('employee.edit', compact('companies', 'employee'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Employee $employee
   * @return RedirectResponse
   */
  public function update(Request $request, $language, Employee $employee): RedirectResponse
  {
    $employee->update($request->except('_token'));
    return redirect()->route('employees.index', $language)->with([
      'successUpdate' => 'You successfully created a new employee info.'
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Employee $employee
   * @return RedirectResponse
   * @throws Exception
   */
  public function destroy($language, Employee $employee): RedirectResponse
  {
    if ($employee->delete()) {
      return back()->with(['success' => 'You successfully deleted the data.']);
    }
    return back();
  }
}
