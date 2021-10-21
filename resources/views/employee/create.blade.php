@extends('layouts.app', ['model' => '', 'value' => ''])

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Add new employee') }}</div>
          <div class="card-body">
            <form action="{{ route('employees.store', app()->getLocale()) }}" method="post">
              @csrf
              <div class="col-md-3 mb-3 p-0">
                <label for="validationCustom04">Select the company</label>
                <select name="company_id" class="custom-select @error('company_id') is-invalid @enderror" id="validationCustom04" required>
                  <option selected disabled value="">Choose...</option>
                  @forelse($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                  @empty
                    <option>NO RECORD AVAILABLE</option>
                  @endforelse
                </select>
                @error('company_id')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="InputFirstname">Firstname</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}"
                       class="form-control @error('first_name') is-invalid @enderror" id="InputFirstname">
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="InputLastname">Lastname</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}"
                       class="form-control @error('last_name') is-invalid @enderror" id="InputLastname">
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="InputEmail">Email address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror" id="InputEmail">
                @error('email')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>


              <div class="form-group">
                <label for="inputPhoneNumber">Phone number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                       class="form-control @error('phone_number') is-invalid @enderror" id="inputPhoneNumber">
                @error('phone_number')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>


              <button type="submit" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


