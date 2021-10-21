@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Companies') }}</div>
          <div class="card-body">
            <a href="{{ route('companies.create') }}" class="btn btn-success">Create new company</a>

            <div class="card mt-3">
              <div class="card-header">{{ __('Companies List') }}</div>
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Website</th>
                    <th>Email</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
