@extends('layout')

@section('content')

  <div>
    <a href="{{ url('boletas/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>Nuevo</a>
    <h4 class="fw-bold py-3 mb-2">Boletas</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead>
          <tr>
            <th>Número</th>
            <th>Sorteo</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Saldo</th>
            <th>Ver</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $boleta)
          <tr>
            <td><strong>{{ $boleta->numero }}</strong></td>
            <td>{{ $boleta->sorteo->nombre }}</td>
            <td>{{ isset($boleta->cliente->nombre) ? $boleta->cliente->nombre : '-'  }}</td>
            <td>{{ isset($boleta->vendedor->nombre) ? $boleta->vendedor->nombre : '-' }}</td>
            <td>$ {{ isset($boleta->saldo) ? $boleta->saldo : 0 }}</td>
            <td>
              <a href="#" class="btn btn-outline-dark btn-sm btn-show" title="Detail boleta" data-value="{{ $boleta->id }}">
                <i class="bx bx-search"></i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="boletaModal" tabindex="-1" aria-labelledby="boletaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="boletaModalLabel">Product details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>Name:</th>
              <td><span id="boletaName"></span></td>
            </tr>
            <tr>
              <th>Image:</th>
              <td><span id="boletaImage"></span></td>
            </tr>
            <tr>
              <th>Category:</th>
              <td><span id="boletaCategory"></span></td>
            </tr>
            <tr>
              <th>Price:</th>
              <td><span id="boletaPrice"></span></td>
            </tr>
            <tr>
              <th>Bestseller:</th>
              <td><span id="boletaBestseller"></span></td>
            </tr>
            <tr>
              <th>Status:</th>
              <td><span id="boletaStatus"></span></td>
            </tr>
            <tr>
              <th>Created at:</th>
              <td><span id="boletaCreatedAt"></span></td>
            </tr>
            <tr>
              <th>Last update:</th>
              <td><span id="boletaUpdatedAt"></span></td>
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
          url: '{{ url("boletas/bestseller/") }}/' + id,
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
      
        boleta = $(this).data('value');

        $.ajax({
          url : "boletas/" + boleta,
          method : 'GET',
          success : function(data){
            $('#boletaName').text(data.boleta.name);
            $('#boletaImage').html("<img src='{{url('images/boletas')}}/"+data.boleta.image+"' class='rounded' style='width: 80px'>");
            $('#boletaCategory').text(data.boleta.category.name);
            $('#boletaPrice').text("$ "+data.boleta.price);
            $('#boletaBestseller').text( (data.boleta.bestseller) ? "Yes" : "No");

            if(data.boleta.status)
              $('#boletaStatus').html('<span class="badge bg-label-success me-1">Active</span>');
            else
              $('#boletaStatus').html('<span class="badge bg-label-danger me-1">Inactive</span>');

            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
            var date = new Date(data.boleta.created_at);
            var date2 = new Date(data.boleta.updated_at);
            var formatted_date = date.toLocaleDateString('en-US', options);
            var formatted_date2 = date2.toLocaleDateString('en-US', options);

            $('#boletaCreatedAt').text(formatted_date);
            $('#boletaUpdatedAt').text(formatted_date2);
            
            $("#boletaModal").modal("toggle");
          }
        });

      });
    
    });

  </script>
@stop