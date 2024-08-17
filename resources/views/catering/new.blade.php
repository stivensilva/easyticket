@extends('layout')

@section('content')

  <div>
    <a href="{{ url('catering') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">New catering</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ url('catering') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bx-purchase-tag"></i>
                  </span>
                  <input
                    type="text"
                    name="name"
                    class="form-control"
                    autofocus
                    required
                    value="{{ old('name') }}"
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
                    required
                    value="{{ old('image') }}"
                  />
                </div>
                @error('image')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Category</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bx-category"></i>
                  </span>
                  <select name="category_id" class="form-control" required >
                    <option value="">Select category...</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                @error('category_id')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-company">Price</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-dollar"></i>
                  </span>
                  <input
                    type="number"
                    name="price"
                    class="form-control"
                    step=".01"
                    min="0"
                    value="{{ old('price') }}"
                  />
                </div>
                @error('price')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Bestseller</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bx-star"></i>
                  </span>
                  <select name="bestseller" class="form-control" required>
                    <option value="0" {{ old('bestseller') == '0' ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('bestseller') == '1' ? 'selected' : '' }}>Yes</option>
                  </select>
                </div>
                @error('bestseller')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Status</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bx-check-circle"></i>
                  </span>
                  <select name="status" class="form-control" required>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                  </select>
                </div>
                @error('status')
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
                    required
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