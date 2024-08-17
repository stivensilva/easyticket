@extends('layout')

@section('content')

  <div>
    <a href="{{ url('usuarios') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">Editar Usuario</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
       <form action="{{ url('usuarios/'.$data->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')


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
                    value="{{ old('nombre',$data->nombre) }}"
                  />
                </div>
                @error('nombre')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-1">
                <a href="{{ url('images/users/'.$data->foto) }}" data-lightbox="{{ $data->nombre }}" data-title="{{ $data->nombre }}">
                  <img src="{{ url('images/users/'.$data->foto) }}" alt="" style="height: 80px; width:80px; border: 1px solid #d9dee3; padding: 2px; border-radius: 10px;">
                </a>
              </div>

              <div class="mb-3 col-md-5">
                <label class="form-label" for="basic-icon-default-company">Cambiar Foto</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-image-add"></i>
                  </span>
                  <input
                    type="file"
                    name="foto"
                    class="form-control"
                    accept="image/*"
                  />
                </div>
                @error('foto')
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
                    value="{{ old('email',$data->email) }}"
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
                    value="{{ old('telefono',$data->telefono) }}"
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
                    value="{{ old('direccion',$data->direccion) }}"
                  />
                </div>
                @error('direccion')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>
              
             {{--<div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Password</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-user"></i>
                  </span>
                  <input
                    type="password"
                    name="password"
                    class="form-control"
                    required
                    value="{{ old('password') }}"
                  />
                </div>
                @error('password')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>--}}

               <div class="mb-3 col-md-8">
                <label class="form-label" for="basic-icon-default-fullname">Rol</label>
                <div class="input-group input-group-merge">
                    <span id="basic-icon-default-fullname2" class="input-group-text">
                        <i class="bx bx-star"></i>
                    </span>
                    <select name="rol" class="form-control" required autofocus>
                        <option value="">Seleccione...</option>
                        <option value="et_admin" {{ $data->rol == 'et_admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="et_vendedor" {{ $data->rol == 'et_vendedor' ? 'selected' : '' }}>Vendedor</option>
                        <option value="et_cliente" {{ $data->rol == 'et_cliente' ? 'selected' : '' }}>Cliente</option>
                    </select>
                </div>
                @error('rol')
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