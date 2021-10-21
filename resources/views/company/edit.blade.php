@extends('layouts.app', ['model' => 'company', 'value' => $company->id])

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Edit company') }}</div>
          <div class="card-body">
            <form action="{{ route('companies.update', ['company' => $company->id, 'language' => app()->getLocale()]) }}"
                  method="post"
                  enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="InputName">Name</label>
                <input type="text" name="name"
                       value="{{ old('name', $company->name) }}"
                       class="form-control"
                       id="InputName">
              </div>

              <div class="form-group">
                <label for="InputEmail">Email address</label>
                <input type="email" name="email" value="{{ old('email', $company->email) }}" class="form-control"
                       id="InputEmail">
              </div>

              <div class="form-group">
                <label for="uploadImage">Browse</label>
                <input type="file" accept="image/*" name="logo" class="form-control-file" id="uploadImage">
                <small id="fileUploadRecom" class="form-text text-muted">Image size (100 x 100)</small>
              </div>

              <div class="form-group">
              <img src="{{ asset('storage/uploads/' . $company->logo) }}" alt="" id="displayImage"
                   style="width:100px;height: 100px;object-fit: cover">
              </div>

              <div class="form-group">
                <label for="InputWebsite">Website</label>
                <input type="text" name="website" value="{{ old('website', $company->website) }}" class="form-control"
                       id="InputWebsite">
              </div>

              <div class="form-group">
                <label for="textAddress">Address</label>
                <textarea class="form-control" name="address" id="textAddress"
                          rows="5">{{old('address', $company->address)}}</textarea>
              </div>

              <button type="submit" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
    const imgInp = document.getElementById('uploadImage');
    imgInp.onchange = evt => {
      const [file] = imgInp.files
      if (file) {
        document.getElementById('displayImage').src = URL.createObjectURL(file)
      }
    }
  </script>
@endpush
