@extends('layout')

@section('content')

  <div>
    <a href="{{ url('boletas') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Volver</a>
    <h4 class="fw-bold py-3 mb-2">Nueva Boleta</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ url('boletas') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

              
            <div class="mb-3 col-md-12">
                <label class="form-label" for="basic-icon-default-fullname">Sorteo</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bx-star"></i>
                  </span>
                  <select name="sorteo" class="form-control" required autofocus>
                    <option value="">Seleccione...</option>
                    @foreach ($sorteos as $sorteo)
                      <option value="{{ $sorteo->id }}">{{ $sorteo->nombre . " (" . $sorteo->fecha_sorteo . ")" }}</option>
                    @endforeach
                  </select>
                </div>
                @error('sorteo')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Desde</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bx-purchase-tag"></i>
                  </span>
                  <input
                    type="number"
                    name="desde"
                    class="form-control"
                    min=0
                    required
                    value="{{ old('desde') }}"
                  />
                </div>
                @error('desde')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Hasta</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bx-purchase-tag"></i>
                  </span>
                  <input
                    type="number"
                    name="hasta"
                    class="form-control"
                    required
                    value="{{ old('hasta') }}"
                  />
                </div>
                @error('hasta')
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