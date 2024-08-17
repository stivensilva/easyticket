@extends('layout')

@section('content')

  <div>
    <a href="{{ url('customers') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Back</a>
    <h4 class="fw-bold py-3 mb-2">New customer</h4>
  </div>

  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <form action="{{ url('customers') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                    value="{{ old('name') }}"
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
                    value="{{ old('email') }}"
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
                    value="{{ old('phone') }}"
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
                    value="{{ old('zipcode') }}"
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
                    <option value="">Select a month...</option>
                        <option value="1" {{ old('birthmonth') == '1' ? 'selected' : '' }}>January</option>
                        <option value="2" {{ old('birthmonth') == '2' ? 'selected' : '' }}>February</option>
                        <option value="3" {{ old('birthmonth') == '3' ? 'selected' : '' }}>March</option>
                        <option value="4" {{ old('birthmonth') == '4' ? 'selected' : '' }}>April</option>
                        <option value="5" {{ old('birthmonth') == '5' ? 'selected' : '' }}>May</option>
                        <option value="6" {{ old('birthmonth') == '6' ? 'selected' : '' }}>June</option>
                        <option value="7" {{ old('birthmonth') == '7' ? 'selected' : '' }}>July</option>
                        <option value="8" {{ old('birthmonth') == '8' ? 'selected' : '' }}>August</option>
                        <option value="9" {{ old('birthmonth') == '9' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ old('birthmonth') == '10' ? 'selected' : '' }}>October</option>
                        <option value="11" {{ old('birthmonth') == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ old('birthmonth') == '12' ? 'selected' : '' }}>December</option>
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
                    @for ($i = 1; $i <= 31; $i++) {
                      <option value='{{ $i }}'>{{ $i }}</option>";
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