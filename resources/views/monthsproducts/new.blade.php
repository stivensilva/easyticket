@extends('layout')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .select2-container .select2-selection--single{
            height: 39px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 6px;
        }
    </style>
@stop

@section('scripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() { $("select").select2(); });
    </script>
@stop

@section('content')

  <div>
    <a href="{{ url('products-of-the-month') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">Create products of the month</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ url('products-of-the-month') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="product-content mb-5">
                <h5>Date range</h5>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-icon-default-fullname">Start date</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="bx bx-calendar"></i>
                      </span>
                    <input type="date" id="startdate" name="startdate" class="form-control" required="" value="">
                    </div>
                    @error('startdate')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
                  
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-icon-default-fullname">End date</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="bx bx-calendar"></i>
                      </span>
                    <input type="date" id="enddate" name="enddate" class="form-control" required="" value="">
                    </div>
                    @error('enddate')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
                </div>
            </div>
        
        
            <div class="product-content mb-5">
                <h5>Product # 1</h5>
                <div class="row">
                        
                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-fullname">Product</label>
                    <div class="input-group input-group-merge">
                      <!--<span id="basic-icon-default-fullname2" class="input-group-text">-->
                      <!--  <i class="bx bx-purchase-tag"></i>-->
                      <!--</span>-->
                      <select name="product_1" class="form-control" required autofocus>
                        <option value="">Select product...</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('product_1')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
                  
                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-fullname">Title</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="bx bx-star"></i>
                      </span>
                      <input
                        type="text"
                        name="title_1"
                        class="form-control"
                        required
                        value="{{ old('title_1') }}"
                      />
                    </div>
                    @error('title_1')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
    
                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-company">Offer</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text">
                        <i class="bx bx-dollar"></i>
                      </span>
                      <input
                        type="text"
                        name="promo_1"
                        class="form-control"
                        value="{{ old('promo_1') }}"
                        required
                      />
                    </div>
                    @error('promo_1')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
                  
                  <div class="mb-3 col-md-12">
                    <label class="form-label" for="basic-icon-default-company">Image</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text">
                        <i class="bx bx-image-add"></i>
                      </span>
                      <input
                        type="file"
                        name="photo_1"
                        class="form-control"
                        accept="image/*"
                        value="{{ old('photo') }}"
                        required
                      />
                    </div>
                    @error('photo_1')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
            
                </div>
            </div>
            
            <div class="product-content mb-5">
                <h5>Product # 2</h5>
                <div class="row">
                        
                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-fullname">Product</label>
                    <div class="input-group input-group-merge">
                      <!--<span id="basic-icon-default-fullname2" class="input-group-text">-->
                      <!--  <i class="bx bx-purchase-tag"></i>-->
                      <!--</span>-->
                      <select name="product_2" class="form-control" required autofocus>
                        <option value="">Select product...</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('product_2')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>

                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-fullname">Title</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="bx bx-star"></i>
                      </span>
                      <input
                        type="text"
                        name="title_2"
                        class="form-control"
                        required
                        value="{{ old('tilte_2') }}"
                      />
                    </div>
                    @error('title_2')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
    
                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-company">Offer</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text">
                        <i class="bx bx-dollar"></i>
                      </span>
                      <input
                        type="text"
                        name="promo_2"
                        class="form-control"
                        value="{{ old('promo_2') }}"
                        required
                      />
                    </div>
                    @error('promo_2')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
                  
                  <div class="mb-3 col-md-12">
                    <label class="form-label" for="basic-icon-default-company">Image</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text">
                        <i class="bx bx-image-add"></i>
                      </span>
                      <input
                        type="file"
                        name="photo_2"
                        class="form-control"
                        accept="image/*"
                        value="{{ old('photo') }}"
                        required
                      />
                    </div>
                    @error('photo_2')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
            
                </div>
            </div>
            
            <div class="product-content mb-3">
                <h5>Product # 3</h5>
                <div class="row">
                        
                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-fullname">Product</label>
                    <div class="input-group input-group-merge">
                      <!--<span id="basic-icon-default-fullname2" class="input-group-text">-->
                      <!--  <i class="bx bx-purchase-tag"></i>-->
                      <!--</span>-->
                      <select name="product_3" class="form-control" required autofocus>
                        <option value="">Select product...</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('product_3')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
                  
                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-fullname">Title</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="bx bx-star"></i>
                      </span>
                      <input
                        type="text"
                        name="title_3"
                        class="form-control"
                        required
                        value="{{ old('title') }}"
                      />
                    </div>
                    @error('title_3')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
    
                  <div class="mb-3 col-md-4">
                    <label class="form-label" for="basic-icon-default-company">Offer</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text">
                        <i class="bx bx-dollar"></i>
                      </span>
                      <input
                        type="text"
                        name="promo_3"
                        class="form-control"
                        value="{{ old('promo') }}"
                        required
                      />
                    </div>
                    @error('promo_3')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
                  
                  <div class="mb-3 col-md-12">
                    <label class="form-label" for="basic-icon-default-company">Image</label>
                    <div class="input-group input-group-merge">
                      <span id="basic-icon-default-company2" class="input-group-text">
                        <i class="bx bx-image-add"></i>
                      </span>
                      <input
                        type="file"
                        name="photo_3"
                        class="form-control"
                        accept="image/*"
                        value="{{ old('photo') }}"
                        required
                      />
                    </div>
                    @error('photo_3')
                      <small class="error-message"> {{ $message }} </small>
                    @enderror
                  </div>
    
                </div>
            </div>
            
            
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
            
          </form>
        </div>
      </div>
    </div>
  </div>
  
@stop