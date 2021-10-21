@extends('layouts.app', ['model' => '', 'value' => ''])

@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Companies') }}</div>
          <div class="card-body">
            <a href="{{ route('companies.create', app()->getLocale()) }}" class="btn btn-success">Create new company</a>

            @if(session()->has('success'))
              <div class="alert alert-danger mt-3">
                <div>You successfully deleted the record.</div>
              </div>
            @endif

            @if(session()->has('successStore'))
              <div class="alert alert-success mt-3">
                <div>You successfully created a new company info.</div>
              </div>
            @endif

            @if(session()->has('successUpdate'))
              <div class="alert alert-info mt-3">
                <div>You successfully updated the company info.</div>
              </div>
            @endif

            <div class="card mt-3">
              <div class="card-header">{{ __('Companies List') }}</div>
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Logo</th>
                    <th>{{__('Name')}}</th>
                    <th>{{ __('Address') }}</th>
                    <th>{{ __('Website') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse($companies as $company)
                    <tr>
                      <td>
                        <img class="avatar"
                             src="{{ asset('storage/uploads/' . $company->logo) }}"
                             alt="{{ $company->name }}">
                      </td>
                      <td>{{ $company->name }}</td>
                      <td>{{ $company->address }}</td>
                      <td>{{ $company->website  }}</td>
                      <td>{{ $company->email }}</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a
                            href="{{ route('companies.edit', ['company' => $company->id, 'language' => app()->getLocale()]) }}"
                            class="btn btn-info">Edit</a>
                          <a onclick="event.preventDefault();document.getElementById('btnDelete').submit();"
                             class="btn btn-danger">Delete</a>
                          <form id="btnDelete"
                                action="{{ route('companies.destroy', ['company' => $company->id, 'language' => app()->getLocale()]) }}"
                                method="post" class="d-none">
                            @csrf
                            @method('DELETE')
                          </form>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5">NO RECORD FOUND</td>
                    </tr>
                  @endforelse
                  </tbody>
                </table>
                <div class="d-flex">
                  <div class="mx-auto">
                    {{ $companies->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    function deleteCompanies(id) {
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            fetch('companies/' + id, {
              method: 'DELETE',
            }).then(res => res.json())
              .then(res => console.log(res))
              .catch(err => console.log(err))
          }
        });
    }
  </script>
@endpush
