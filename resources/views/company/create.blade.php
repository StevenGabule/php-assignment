@extends('layouts.app', ['model' => '', 'value' => ''])

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Add new company') }}</div>
          <div class="card-body">
            <form action="{{ route('companies.store', app()->getLocale()) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="InputName">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror" id="InputName">
                @error('name')
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
                <label for="uploadImage">Browse</label>
                <input type="file" name="logo" class="form-control-file @error('logo') is-invalid @enderror" id="uploadImage">
                <small id="fileUploadRecom" class="form-text text-muted">Image size (100 x 100)</small>

                @error('logo')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <img src="https://via.placeholder.com/100x100" alt="" id="displayImage"
                     style="width:100px;height: 100px;object-fit: cover">
              </div>

              <div class="form-group">
                <label for="InputWebsite">Website</label>
                <input type="text" name="website" value="{{ old('website') }}"
                       class="form-control @error('website') is-invalid @enderror" id="InputWebsite">
                @error('website')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="textAddress">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="textAddress"
                          rows="5">{{old('address')}}</textarea>
                @error('address')
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

