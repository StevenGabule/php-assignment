<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\Company\CreateCompanyRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class CompanyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Application|Factory|View
   */
  public function index()
  {
    $companies = Company::orderByDesc('created_at')->paginate(10);
    return view('company.index', compact('companies'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Application|Factory|View
   */
  public function create()
  {
    return view('company.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param CreateCompanyRequest $request
   * @return RedirectResponse
   */
  public function store(CreateCompanyRequest $request): RedirectResponse
  {
    $image = $request->file('logo');
    $image->getPathName();
    $filename = time() . '_' . preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
    Company::create($request->except('_token', 'logo') + ['logo' => $filename]);
    $image->storeAs('uploads', $filename, 'public');
    return redirect()->route('companies.index', app()->getLocale())->with(['successStore' => 'You successfully created a new company info.']);
  }

  /**
   * Display the specified resource.
   *
   * @param Company $company
   * @return Response
   */
  public function show(Company $company)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Company $company
   * @return Application|Factory|View
   */
  public function edit($language, Company $company)
  {
    return view('company.edit', compact('company'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Company $company
   * @return RedirectResponse
   */
  public function update(Request $request, $language, Company $company): RedirectResponse
  {
    $filename = '';
    if ($request->file('logo')) {
      $image = $request->file('logo');
      $image->getPathName();
      $filename = time() . '_' . preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
      $image->storeAs('uploads', $filename, 'public');
    }
    $company->update([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'address' => $request->input('address'),
      'website' => $request->input('website'),
      'logo' => $filename == '' ? $company->logo : $filename
    ]);
    return redirect()->route('companies.index', app()->getLocale())->with(['successUpdate' => 'You successfully created a new company info.']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Company $company
   * @return RedirectResponse
   * @throws Exception
   */
  public function destroy($language, Company $company): RedirectResponse
  {
    $filename = $company->logo;
    if ($company->delete()) {
      $avatarPath = storage_path('app\\public\\uploads\\') . $filename;
      if (File::exists($avatarPath)) File::delete($avatarPath);
    }
    return back()->with(['success' => 'You successfully deleted the data.']);
  }
}
