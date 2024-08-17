@extends('layout')

@section('content')

  <div>
    <a href="{{ url('customers') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">Edit customer</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
        <form action="{{ url('customers/'.$data->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="row">

              <div class="mb-3 col-md-6">
                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-discount"></i>
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

              <div class="mb-3 col-md-3">
                <label class="form-label" for="basic-icon-default-company">Phone</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-phone"></i>
                  </span>
                  <input
                    type="number"
                    name="phone"
                    class="form-control"
                    required
                    value="{{ old('phone', $data->phone) }}"
                  />
                </div>
                @error('phone')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-3">
                <label class="form-label" for="basic-icon-default-fullname">Zip code</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text">
                    <i class="bx bxs-mailbox"></i>
                  </span>
                  <input
                    type="number"
                    name="zipcode"
                    class="form-control"
                    required
                    value="{{ old('zipcode', $data->zipcode) }}"
                  />
                </div>
                @error('zipcode')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>

              <div class="mb-3 col-md-3">
                <label class="form-label" for="basic-icon-default-company">Birth month</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-calendar"></i>
                  </span>
                  <select name="birthmonth" class="form-control" required>
                    @foreach( $months as $i => $month)
                      <option value="{{ $i + 1 }}" {{ (old('phone', $data->birthmonth) == $i + 1 ) ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                  </select>
                </div>
                @error('birthmonth')
                  <small class="error-message"> {{ $message }} </small>
                @enderror
              </div>
              
              <div class="mb-3 col-md-3">
                <label class="form-label" for="basic-icon-default-company">Birth day</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text">
                    <i class="bx bx-calendar"></i>
                  </span>
                  <select name="birthday" class="form-control" required>
                    @for ($i = 1; $i <= 31; $i++)
                      <option value='{{ $i }}' {{ (old('phone', $data->birthday) == $i ) ? 'selected' : '' }}>{{ $i }}</option>";
                    @endfor
                  </select>
                </div>
                @error('birthday')
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