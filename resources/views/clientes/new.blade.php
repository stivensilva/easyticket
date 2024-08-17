@php
  use Illuminate\Support\Str;
  $customerKey = Str::random(32);
@endphp

@extends('layout')

@section('content')
  <div>
    <a href="{{ url('clientes') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Volver</a>
    <h4 class="fw-bold py-3 mb-2">Nuevo Cliente</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ url('clientes') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Nombre</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-user"></i>
                  </span>
                  <input
                    type="text"
                    name="nombre"
                    class="form-control"
                    required
                    autofocus
                    value="{{ old('nombre') }}"
                  />
                </div>
                @error('nombre')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">E-mail</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-user"></i>
                  </span>
                  <input
                    type="email"
                    name="email"
                    class="form-control"
                    required
                    value="{{ old('email') }}"
                  />
                </div>
                @error('email')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Telefono</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-user"></i>
                  </span>
                  <input
                    type="number"
                    name="telefono"
                    min=7
                    class="form-control"
                    required
                    value="{{ old('telefono') }}"
                  />
                </div>
                @error('telefono')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Direccion</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-user"></i>
                  </span>
                  <input
                    type="text"
                    name="direccion"
                    class="form-control"
                    required
                    value="{{ old('direccion') }}"
                  />
                </div>
                @error('direccion')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <!-- Hidden input para customer_key -->
              <input
                type="hidden"
                name="customer_key"
                class="form-control"
                value="{{ $customerKey }}"
              />
              @error('customer_key')
                <small class="error-message"> {{ $message }} </small>
              @enderror

              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop

