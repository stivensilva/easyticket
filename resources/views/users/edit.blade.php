@extends('layout')

@section('content')

  <div>
    <a href="{{ url('users') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">Edit user</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
        <form action="{{ url('users/'.$data->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="row">

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-user"></i>
                  </span>
                  <input
                    type="text"
                    name="name"
                    class="form-control"
                    required
                    autofocus
                    value="{{ old('name', $data->name) }}"
                  />
                </div>
                @error('name')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>
              
              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-company">E-mail</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-envelope"></i>
                  </span>
                  <input
                    type="email"
                    name="email"
                    class="form-control"
                    required
                    value="{{ old('email', $data->email) }}"
                  />
                </div>
                @error('email')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-company">Password</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-lock"></i>
                  </span>
                  <input
                    type="password"
                    name="password"
                    class="form-control"
                    required
                  />
                </div>
                @error('phone')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-3">
                <label class="form-label" for="basic-icon-default-company">Role</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-id-card"></i>
                  </span>
                  <select name="role" class="form-control" required>
                    @if($data->role == 'Super Admin')
                      <option value='Super Admin' selected>Super Admin</option>
                      <option value='Admin'>Admin</option>
                      <option value='Supervisor'>Supervisor</option>
                    @elseif($data->role == 'Admin')
                      <option value='Admin' selected>Admin</option>
                      <option value='Supervisor'>Supervisor</option>
                    @endif
                  </select>
                </div>
                @error('role')
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