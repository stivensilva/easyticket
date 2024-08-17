@extends('layout')

@section('content')

  <div>
    <a href="{{ url('sorteos/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>New</a>
    <h4 class="fw-bold py-3 mb-2">Sorteos</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover ">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Valor boleta</th>
            <th>Fecha sorteo</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Premio</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $sorteo)
          <tr>
            <td><strong>{{ $sorteo->nombre }}</strong></td>
            <td>{{ $sorteo->descripcion }}</td>
            <td>$ {{ number_format($sorteo->valor_boleta, 0, ',', '.') }}</td>
            <td>{{ $sorteo->fecha_sorteo }}</td>
            <td>{{ $sorteo->fecha_inicio }}</td>
            <td>{{ $sorteo->fecha_fin }}</td>
            <td>{{ $sorteo->premio }}</td>
            <td>
              <a href="javascript:void(0);" class="btn btn-outline-dark btn-sm btn-show" title="Detail sorteo" data-value="{{ $sorteo->id }}">
                <i class="bx bx-search"></i>
              </a>
              <a href="{{ url('sorteos/'.$sorteo->id.'/edit') }}" class="btn btn-outline-dark btn-sm" title="Edit sorteo">
                <i class="bx bx-pencil"></i>
              </a>
              <!-- <form action="{{ url('sorteos/'.$sorteo->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                @if($sorteo->status)
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Inactivate sorteo" onclick="return confirm('Are you sure you want to inactivate this sorteo?')">
                    <i class="bx bx-trash"></i>
                  </button>
                @else
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Activate sorteo" onclick="return confirm('Are you sure you want to activate this sorteo?')">
                    <i class="bx bx-recycle"></i>
                  </button>
                @endif
              </form> -->
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="sorteoModal" tabindex="-1" aria-labelledby="sorteoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sorteoModalLabel">Detalle del sorteo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="sorteo" style="text-align:center">
            <p id="sorteoProduct" style="font-size:38px; font-weight:bold;  margin-bottom: 10px; color:#000"></p>
            <p id="sorteoPromotion" style="font-size:28px; font-weight:bold; position: relative; color:red; margin-bottom: 15px; margin-top: 0px; line-height:1"></p>
            <p style="font-size:18px; margin-bottom:5px">
              <strong>Inicia el </strong><span id="sorteoStartdate"></span>  
              <strong>hasta el </strong><span id="sorteoEnddate"></span>
            </p>
            <p id="sorteoStatus" style="font-size: 36px"></p>
          </div>

          <!-- <table class="table table-striped">
            <tr>
              <th>Product:</th>
              <td><span id="sorteoProduct"></span></td>
            </tr>
            <tr>
              <th>Promotion:</th>
              <td><span id="sorteoPromotion"></span></td>
            </tr>
            <tr>
              <th>Start date:</th>
              <td><span id="sorteoStartdate"></span></td>
            </tr>
            <tr>
              <th>End date:</th>
              <td><span id="sorteoEnddate"></span></td>
            </tr>
            <tr>
              <th>Status:</th>
              <td><span id="sorteoStatus"></span></td>
            </tr>
            <tr>
              <th>Created at:</th>
              <td><span id="sorteoCreatedAt"></span></td>
            </tr>
            <tr>
              <th>Last update:</th>
              <td><span id="sorteoUpdatedAt"></span></td>
            </tr>
          </table> -->
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
      
        sorteo = $(this).data('value');

        $.ajax({
          url : "sorteos/" + sorteo,
          method : 'GET',
          success : function(data){

            $('#sorteoProduct').text(data.sorteo.nombre);
            $('#sorteoPromotion').text(data.sorteo.descripcion);
            $('#sorteoStartdate').text(data.sorteo.fecha_inicio);
            $('#sorteoEnddate').text(data.sorteo.fecha_fin);
          
            $('#sorteoStatus').html('<span class="badge bg-label-success me-1">Active</span>');
             

            var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
            var date = new Date(data.sorteo.created_at);
            var date2 = new Date(data.sorteo.updated_at);
            var formatted_date = date.toLocaleDateString('en-US', options);
            var formatted_date2 = date2.toLocaleDateString('en-US', options);

            $('#sorteoCreatedAt').text(formatted_date);
            $('#sorteoUpdatedAt').text(formatted_date2);
            
            $("#sorteoModal").modal("toggle");
          }
        });

      });
    
    });

  </script>
@stop