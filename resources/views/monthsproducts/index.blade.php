@extends('layout')

@section('content')

  <div>
    <a href="{{ url('products-of-the-month/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>Set</a>
    <a href="{{ url('products-of-the-month/0/edit') }}" class="btn btn-info float-end mx-3"><i class="bx bx-pencil"></i>Edit</a>
    <h4 class="fw-bold py-3 mb-2">Products of the month</h4>
  </div>

  <div class="card p-3">    
      <div class="container-fluid service py-3">
        <div class="container">
            @if( count($data) > 0)
                <h4>Current products</h4>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary" style="background-color: #ffb524 !important; border-color: #ffb524 !important;">
                                <img src="{{ url('images/monthsproducts') .'/'. $data[0]->photo }}" class="img-fluid rounded-top w-100" style="height:284px; background: #fff;" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded" style="background-color: #c8c8c8 !important; border-radius: 10px !important; position: relative;width: 250px;height: 130px;top: -50%;left: 50%;transform: translate(-50%, -50%);">
                                        <h5 class="text-white">{{ $data[0]->title }}</h5>
                                        <h3 class="mb-0">{{ $data[0]->promo }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary" style="background-color: #45595b !important; border-color: #45595b !important;">
                                <img src="{{ url('images/monthsproducts') .'/'. $data[1]->photo }}" class="img-fluid rounded-top w-100" style="height:284px; background: #fff;" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded" style="background-color: #f4f6f8 !important; border-radius: 10px !important; position: relative;width: 250px;height: 130px;top: -50%;left: 50%;transform: translate(-50%, -50%);">
                                        <h5 class="text-primary" style="color: #c8c8c8 !important;">{{ $data[1]->title }}</h5>
                                        <h3 class="mb-0">{{ $data[1]->promo }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
 
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary" style="background-color: #c8c8c8 !important; border-color: #81c408 !important;">
                                <img src="{{ url('images/monthsproducts') .'/'. $data[2]->photo }}" class="img-fluid rounded-top w-100" style="height:284px; background: #fff;" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded" style="background-color: #ffb524 !important; border-radius: 10px !important; position: relative;width: 250px;height: 130px;top: -50%;left: 50%;transform: translate(-50%, -50%);">
                                        <h5 class="text-white">{{ $data[2]->title }}</h5>
                                        <h3 class="mb-0">{{ $data[2]->promo }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <h4>No products assigned</h4>
            @endif
        </div>
    </div>

  </div>

@stop

@section('scripts')

  <script>
  
    $(document).ready(function(){

    });

  </script>
@stop