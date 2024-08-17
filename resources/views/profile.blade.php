@extends('layout')

@section('content')

    <div>
        <a href="{{ url('home') }}" class="btn btn-secondary float-end"><i class="bx bx-undo"></i>Inicio</a>
        <h4 class="fw-bold py-3 mb-2">Perfil</h4>
    </div>
    
    <div class="card p-3">
        <!-- Incluir Bootstrap Icons desde un CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            .image-container {
                position: relative;
                overflow: hidden;
            }
            
            .overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                opacity: 0;
                transition: opacity 0.3s ease;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .overlay label {
                font-size: 2rem;
                cursor: pointer;
            }
            
            .image-container:hover .overlay {
                opacity: 1;
            }

        </style>

        <form id="avatar-form" action="{{ url('avatar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="card-header" style="display: flex; align-items: flex-end;">
                @if(Auth::user()->foto)
                    <div class="image-container">
                        <img id="avatar-image" class="rounded" src="{{ url('images/users/' . Auth::user()->foto) }}" height="80px" width="80px">
                        <div class="overlay">
                            <label for="avatar-input" class="bi bi-pencil-square text-white"></label>
                            <input type="file" name="avatar" id="avatar-input" style="display: none;" accept="image/*" onchange="updateAvatar(this)">
                        </div>
                    </div>
                @else
                    <div class="image-container">
                        <img id="avatar-image" class="rounded " src="{{ url('images/users/1.png') }}" height="80px" width="80px">
                        <div class="overlay">
                            <label for="avatar-input" class="bi bi-pencil-square text-white"></label>
                            <input type="file" name="avatar" id="avatar-input" style="display: none;" accept="image/*" onchange="updateAvatar(this)">
                        </div>
                    </div>
                @endif
                <span class="ms-3">{{ Auth::user()->nombre }}</span>
            </h1>
        </form>
        
        
        <script>
            function updateAvatar(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('avatar-image').src = e.target.result;
                        document.getElementById('avatar-form').submit();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        
            // Abrir el input de tipo file al hacer clic en la imagen
            document.getElementById('avatar-image').addEventListener('click', function() {
                document.getElementById('avatar-input').click();
            });
        </script>


        <hr class="my-0">
        <div class="card-body">
            <form action="{{ url('profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="name" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="name" name="name" autofocus value="{{ Auth::user()->nombre }}" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{ Auth::user()->email }}" required>
                    </div>
    
                    <div class="mb-3 col-md-4">
                        <label for="password" class="form-label">Password <small><i>(Ingresa para cambiar)</i></small></label>
                        <input class="form-control" type="text" name="password" id="password" >
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Actualizar</button>
                </div>
                
            </form>
            
        </div>
    </div>

@stop