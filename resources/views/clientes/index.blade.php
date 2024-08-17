@extends('layout')

@section('content')

  <div>
    <a href="{{ url('clientes/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>Nuevo</a>
    <h4 class="fw-bold py-3 mb-2">Cliente</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead>
          <tr>
            <th>nombre</th>
            <th>email</th>
            <th>telefono</th>
            <th>direccion</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $cliente)
          <tr>
            <td><strong>{{ $cliente->nombre }}</strong></td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->direccion }}</td>
              <td>
              <a href="javascript:void(0);" class="btn btn-outline-dark btn-sm btn-show" title="Detail cliente" data-value="{{ $cliente->id }}">
                <i class="bx bx-search"></i>
              </a>
              <a href="{{ url('clientes/'.$cliente->id.'/edit') }}" class="btn btn-outline-dark btn-sm" title="Edit cliente">
                <i class="bx bx-pencil"></i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="clienteModalLabel">Product details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>Nombre:</th>
              <td><span id="nombre"></span></td>
            </tr>
            <tr>
              <th>Email:</th>
              <td><span id="email"></span></td>
            </tr>
            <tr>
              <th>Telefono:</th>
              <td><span id="telefono"></span></td>
            </tr>
            <tr>
              <th>Direccion:</th>
              <td><span id="direccion"></span></td>
            </tr>
           
            <tr>
              <th>Opciones:</th>
              <td><span id="clienteStatus"></span></td>
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

      $('body').on('click', '.btn-show', function(){
      
        cliente = $(this).data('value');

        $.ajax({
          url : "clientes/" + cliente,
          method : 'GET',
          success : function(data){

            $('#clienteProduct').text(data.cliente.nombre);
            $('#clientePromotion').text(data.cliente.email);
            $('#clienteStartdate').text(data.cliente.telefono);
            $('#clienteEnddate').text(data.cliente.direccion);
          
            $('#clienteStatus').html('<span class="badge bg-label-success me-1">Active</span>');
             

            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
            var date = new Date(data.cliente.created_at);
            var date2 = new Date(data.cliente.updated_at);
            var formatted_date = date.toLocaleDateString('en-US', options);
            var formatted_date2 = date2.toLocaleDateString('en-US', options);

            $('#clienteCreatedAt').text(formatted_date);
            $('#clienteUpdatedAt').text(formatted_date2);
            
            $("#clienteModal").modal("toggle");
          }
        });

      });
    
    });

  </script>
@stop