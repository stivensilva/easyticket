@extends('layout')

@section('content')

  <div>
    <a href="{{ url('catering-categories') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">New catering category</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ url('catering-categories') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bx-user"></i>
                  </span>
                  <input
                    type="text"
                    name="name"
                    class="form-control"
                    autofocus
                    value="{{ old('name') }}"
                    required
                  />
                </div>
                @error('name')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-company">Image</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-image-add"></i>
                  </span>
                  <input
                    type="file"
                    name="image"
                    class="form-control"
                    accept="image/*"
                    value="{{ old('image') }}"
                    required
                  />
                </div>
                @error('image')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-message">Description</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-message2" class="input-group-text">
                    <i class="bx bx-comment"></i>
                  </span>
                  <textarea
                    class="form-control"
                    name="description"
                    rows="5"
                  >{{ old('description') }}</textarea>
                </div>
                @error('description')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
@stop