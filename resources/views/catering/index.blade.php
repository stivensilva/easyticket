@extends('layout')

@section('content')

  <div>
    <a href="{{ url('catering/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>New</a>
    <h4 class="fw-bold py-3 mb-2">Catering</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead>
          <tr>
            <th>Name</th>
            <th>Image</th>
            <!-- <th>Description</th> -->
            <th>Category</th>
            <th>Price</th>
            <th>Bestseller ?</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $catering)
          <tr>
            <td><strong>{{ $catering->name }}</strong></td>
            <td>
              <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                <li
                data-bs-toggle="tooltip"
                data-popup="tooltip-custom"
                data-bs-placement="top"
                class="avatar avatar-xs pull-up"
                title="{{ $catering->name }}"
                >
                  <a href="{{ url('images/catering/'.$catering->image) }}" data-lightbox="{{ $catering->name }}" data-title="{{ $catering->name }}">
                    <img src="{{ url('images/catering/'.$catering->image) }}" alt="Avatar" class="rounded" />
                  </a>
                </li>
              </ul>
            </td>
            <!-- <td>{{ $catering->description }}</td> -->
            <td>{{ $catering->catering_category->name }}</td>
            <td>$ {{ $catering->price }}</td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input toggle-bestseller" data-id="{{ $catering->id }}" type="checkbox" {{ $catering->bestseller ? 'checked' : '' }} style="margin: 0 auto;">
              </div> 
            </td>
            <td>
              @if($catering->status)
                <span class="badge bg-label-success me-1">Active</span>
              @else
                <span class="badge bg-label-danger me-1">Inactive</span>
              @endif 
            </td>
            <td>
              <a href="#" class="btn btn-outline-dark btn-sm btn-show" title="Detail catering" data-value="{{ $catering->id }}">
                <i class="bx bx-search"></i>
              </a>
              <a href="{{ url('catering/'.$catering->id.'/edit') }}" class="btn btn-outline-dark btn-sm" title="Edit catering">
                <i class="bx bx-pencil"></i>
              </a>
              <form action="{{ url('catering/'.$catering->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                @if($catering->status)
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Inactivate catering" onclick="return confirm('Are you sure you want to inactivate this catering?')">
                    <i class="bx bx-trash"></i>
                  </button>
                @else
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Activate catering" onclick="return confirm('Are you sure you want to activate this catering?')">
                    <i class="bx bx-recycle"></i>
                  </button>
                @endif
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">Product details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>Name:</th>
              <td><span id="productName"></span></td>
            </tr>
            <tr>
              <th>Image:</th>
              <td><span id="productImage"></span></td>
            </tr>
            <tr>
              <th>Category:</th>
              <td><span id="productCategory"></span></td>
            </tr>
            <tr>
              <th>Price:</th>
              <td><span id="productPrice"></span></td>
            </tr>
            <tr>
              <th>Bestseller:</th>
              <td><span id="productBestseller"></span></td>
            </tr>
            <tr>
              <th>Status:</th>
              <td><span id="productStatus"></span></td>
            </tr>
            <tr>
              <th>Created at:</th>
              <td><span id="productCreatedAt"></span></td>
            </tr>
            <tr>
              <th>Last update:</th>
              <td><span id="productUpdatedAt"></span></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@stop

@section('scripts')

  <script>
  
    $(document).ready(function(){

      $('body').on('change', '.toggle-bestseller', function() {
        var id = $(this).data('id');
        var isChecked = $(this).prop('checked');
        
        $.ajax({
          url: '{{ url("catering/bestseller/") }}/' + id,
          type: 'GET',
          success: function(response) {
            console.log(response);
          },
          error: function(xhr) {
            console.log(xhr.responseText);
          }
        });
      });

      $('body').on('click', '.btn-show', function(){
      
        catering = $(this).data('value');

        $.ajax({
          url : "catering/" + catering,
          method : 'GET',
          success : function(data){
            $('#productName').text(data.catering.name);
            $('#productImage').html("<img src='{{url('images/catering')}}/"+data.catering.image+"' class='rounded' style='width: 80px'>");
            $('#productCategory').text(data.catering.catering_category.name);
            $('#productPrice').text("$ "+data.catering.price);
            $('#productBestseller').text( (data.catering.bestseller) ? "Yes" : "No");

            if(data.catering.status)
              $('#productStatus').html('<span class="badge bg-label-success me-1">Active</span>');
            else
              $('#productStatus').html('<span class="badge bg-label-danger me-1">Inactive</span>');

            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
            var date = new Date(data.catering.created_at);
            var date2 = new Date(data.catering.updated_at);
            var formatted_date = date.toLocaleDateString('en-US', options);
            var formatted_date2 = date2.toLocaleDateString('en-US', options);

            $('#productCreatedAt').text(formatted_date);
            $('#productUpdatedAt').text(formatted_date2);
            
            $("#productModal").modal("toggle");
          }
        });

      });
    
    });

  </script>
@stop