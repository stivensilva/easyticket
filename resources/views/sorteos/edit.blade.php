@extends('layout')

@section('content')

  <div>
    <a href="{{ url('sorteos') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">Editar Sorteo</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ url('sorteos/'.$data->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="row">

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Nombre</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-discount"></i>
                  </span>
                  <input
                    type="text"
                    name="nombre"
                    class="form-control"
                    required
                    autofocus
                    value="{{ old('nombre', $data->nombre) }}"
                  />
                </div>
                @error('nombre')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Valor boleta</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-discount"></i>
                  </span>
                  <input
                    type="number"
                    name="valor"
                    class="form-control"
                    required
                    min="0"
                    value="{{ old('valor', $data->valor_boleta) }}"
                  />
                </div>
                @error('valor')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-message">Descripción</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-message2" class="input-group-text">
                    <i class="bx bx-comment"></i>
                  </span>
                  <textarea
                    class="form-control"
                    name="descripcion"
                    rows="5"
                    required
                  >{{ old('descripcion', $data->descripcion)  }}</textarea>
                </div>
                @error('descripcion')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>
              
              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-company">Fecha inicio</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-calendar"></i>
                  </span>
                  <input
                    type="date"
                    id="startdate"
                    name="fecha_inicio"
                    class="form-control"
                    required
                    value="{{ old('fecha_inicio', $data->fecha_inicio) }}"
                  />
                </div>
                @error('fecha_inicio')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-company">Fecha fin</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-calendar"></i>
                  </span>
                  <input
                    type="date"
                    id="enddate"
                    name="fecha_fin"
                    class="form-control"
                    required
                    value="{{ old('fecha_fin', $data->fecha_fin) }}"
                  />
                </div>
                @error('fecha_fin')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-company">Fecha sorteo</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-calendar"></i>
                  </span>
                  <input
                    type="date"
                    name="fecha_sorteo"
                    class="form-control"
                    required
                    value="{{ old('fecha_sorteo', $data->fecha_sorteo) }}"
                  />
                </div>
                @error('fecha_sorteo')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Premio</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-discount"></i>
                  </span>
                  <input
                    type="text"
                    name="premio"
                    class="form-control"
                    required
                    value="{{ old('premio', $data->premio) }}"
                  />
                </div>
                @error('premio')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
@stop

@section('scripts')

  <script>
    $(document).ready(function() {
      
      $('#startdate').blur(function() {
        var startDateValue = new Date($(this).val());
        var endDateValue = new Date($('#enddate').val());

        if (endDateValue < startDateValue)
          $('#enddate').val('');
        
      });


      $('#enddate').blur(function() {
        var startDateValue = new Date($('#startdate').val());
        var endDateValue = new Date($(this).val());

        if (endDateValue < startDateValue) {
          alert('La fecha fin debe ser mayor a la fecha de inicio.');
          $(this).val('');
          $(this).focus();
        }
      });

    });
  </script>

@stop