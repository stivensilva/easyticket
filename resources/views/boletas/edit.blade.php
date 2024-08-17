@extends('layout')

@section('content')

  <div>
    <a href="{{ url('products') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">Edit product</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
        <form action="{{ url('products/'.$data->id') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                    value="{{ $data->name }}"
                  />
                </div>
                @error('name')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-1">
                <a href="{{ url('images/products/'.$data->image) }}" data-lightbox="{{ $data->name }}" data-title="{{ $data->name }}">
                  <img src="{{ url('images/products/'.$data->image) }}" alt="" style="height: 80px; width:80px; border: 1px solid #d9dee3; padding: 2px; border-radius: 10px;">
                </a>
              </div>

              <div class="mb-3 col-md-5">
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
                      @if($data->category_id == $category->id)
                        <option value="{{$category->id}}" selected> {{$category->name}} </option>
                      @else
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                      @endif
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
                    value="{{ $data->price }}"
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
                    @if($data->bestseller)
                      <option value="0">No</option>
                      <option value="1" selected>Yes</option>
                    @else
                      <option value="0" selected>No</option>
                      <option value="1">Yes</option>
                    @endif
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
                    @if($data->status)
                      <option value="1" selected>Active</option>
                      <option value="0">Inactive</option>
                    @else
                      <option value="1">Active</option>
                      <option value="0" selected>Inactive</option>
                    @endif
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
                  >{{ $data->description }}</textarea>
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