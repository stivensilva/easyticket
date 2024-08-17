@extends('layout')

@section('content')
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-8">
            <div class="card-body">
              <h4 class="card-title text-primary">Bienvenido {{ Auth::user()->nombre }} 🎉</h4>
              <h1 class="mb-0">
                <span class="fw-bold">Easy</span> Ticket
              </h1>
            </div>
          </div>
          <div class="col-sm-4 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src=" {{ url('assets/img/illustrations/man-with-laptop-light.png') }}"
                height="140"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-info"><i class="bx bx-notepad"></i></span>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt3"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{ url('products') }}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Resultados</span>
              <h2 class="card-title mb-2">{{ 999 }}</h2>
              <!--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>-->
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-success"><i class="bx bx-user"></i></span>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt6"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                    <a class="dropdown-item" href="{{ url('customers') }}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Pacientes</span>
              <h2 class="card-title text-nowrap mb-2">{{ 999 }}</h2>
              <!--<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Total Revenue -->
    <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-8 pb-3">
            <h5 class="card-header m-0 me-2 pb-3">Resultados (último mes)</h5>
            <div id="totalRevenueChart" class="px-2"></div>
          </div>
          <div class="col-md-4">
            
            <div class="d-flex p-4 justify-content-between">
              <div class="d-flex">
                <div class="me-2">
                  <span class="badge bg-label-primary p-2"><i class="bx bx-plus-medical text-primary"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <small>Doctores</small>
                  <h6 class="mb-0">{{ 999 }}</h6>
                </div>
              </div>
            </div>

            <div class="d-flex p-4 justify-content-between">
              <div class="d-flex">
                <div class="me-2">
                  <span class="badge bg-label-info p-2"><i class="bx bx-building text-info"></i></span>
                </div>
                <div class="d-flex flex-column">
                  <small>Sucursales</small>
                  <h6 class="mb-0">{{ 999 }}</h6>
                </div>
              </div>
            </div>
            
            <div id="growthChart" ></div>
          
          </div>
        </div>
      </div>
    </div>
    <!--/ Total Revenue -->
    <div class="col-12 col-md-12 col-lg-12 order-3 order-md-2">
      <div class="row">
          
        <!-- </div><div class="row"> -->
        
        <div class="col-6 col-lg-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-notepad"></i></span>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt4"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <a class="dropdown-item" href="{{ url('coupons') }}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Panorex</span>
              <h2 class="card-title text-nowrap mb-0">{{ 999 }}</h2>
              <!--<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>-->
            </div>
          </div>
        </div>
        
        <div class="col-6 col-lg-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-success"><i class="bx bx-notepad"></i></span>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt4"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <a class="dropdown-item" href="{{ url('coupons') }}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Tomografía</span>
              <h2 class="card-title text-nowrap mb-0">{{ 999 }}</h2>
              <!--<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>-->
            </div>
          </div>
        </div>
        
        <div class="col-6 col-lg-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-notepad"></i></span>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt4"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <a class="dropdown-item" href="{{ url('customer-coupons') }}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">P Parcial</span>
              <h2 class="card-title text-nowrap mb-0">{{ 999 }}</h2>
              <!--<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>-->
            </div>
          </div>
        </div>
        
        <div class="col-6 col-lg-3 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-notepad"></i></span>
                </div>
                <div class="dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt4"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <a class="dropdown-item" href="{{ url('customer-coupons') }}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">JPPC</span>
              <h2 class="card-title text-nowrap mb-0">{{ 999 }}</h2>
              <!--<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>-->
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>

@stop