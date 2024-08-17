@extends('layout')

@section('content')

  <div>
    <a href="{{ url('usuarios/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>Nuevo</a>
    <h4 class="fw-bold py-3 mb-2">Usuario</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead>
          <tr>
            <th>nombre</th>
            <th>foto</th>
            <th>email</th>
            <th>telefono</th>
            <th>direccion</th>
            <th>rol</th>
            <th>opciones</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $usuario)
          <tr>
            <td><strong>{{ $usuario->nombre }}</strong></td>
            <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar avatar-xs pull-up"
                  title="{{ $usuario->foto }}"
                  >
                    <a href="{{ url('images/users/'.$usuario->foto) }}" data-lightbox="{{ $usuario->nombre }}" data-title="{{ $usuario->nombre }}">
                      <img src="{{ url('images/users/'.$usuario->foto) }}" alt="Avatar" class="rounded" />
                    </a>
                  </li>
                </ul>
              </td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->telefono }}</td>
            <td>{{ $usuario->direccion }}</td>
            <td>{{ $usuario->rol }}</td>
              <td>
              <a href="javascript:void(0);" class="btn btn-outline-dark btn-sm btn-show" title="Detail usuario" data-value="{{ $usuario->id }}">
                <i class="bx bx-search"></i>
              </a>
              <a href="{{ url('usuarios/'.$usuario->id.'/edit') }}" class="btn btn-outline-dark btn-sm" title="Edit usuario">
                <i class="bx bx-pencil"></i>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="usuarioModal" tabindex="-1" aria-labelledby="usuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="usuarioModalLabel">Product details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>Nombre:</th>
              <td><span id="nombre"></span></td>
            </tr>
            <tr>
              <th>Foto:</th>
              <td><span id="email"></span></td>
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
              <th>Rol:</th>
              <td><span id="rol"></span></td>
            </tr>
            <tr>
              <th>Opciones:</th>
              <td><span id="opciones"></span></td>
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
      
        usuario = $(this).data('value');

        $.ajax({
          url : "usuarios/" + usuario,
          method : 'GET',
          success : function(data){

            $('#usuarioNombre').text(data.usuario.nombre);
            $('#usuarioPromotion').text(data.usuario.foto);
            $('#usuarioStartdate').text(data.usuario.email);
            $('#usuarioStartdate').text(data.usuario.telefono);
            $('#usuarioEnddate').text(data.usuario.direccion);
            $('#usuarioEnddate').text(data.usuario.rol);
          
            $('#usuarioStatus').html('<span class="badge bg-label-success me-1">Active</span>');
             

            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZonenombre: 'short' };
            var date = new Date(data.usuario.created_at);
            var date2 = new Date(data.usuario.updated_at);
            var formatted_date = date.toLocaleDateString('en-US', options);
            var formatted_date2 = date2.toLocaleDateString('en-US', options);

            $('#usuarioCreatedAt').text(formatted_date);
            $('#usuarioUpdatedAt').text(formatted_date2);
            
            $("#usuarioModal").modal("toggle");
          }
        });

      });
    
    });

  </script>
@stop