@extends('layouts.app')
@section('subtitle', 'Vehículos')
@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-users"></i> Asignar un Rol
               {{--  <button class="btn btn-app bg-dark" type="button" data-toggle="modal" data-target="#userModal">
                    <i class="fas fa-plus-circle"></i>Nuevo
                </button> --}}
                </h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-fw fa-house-user"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}"><i class="fa fa-fw fa-users"></i> Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user-edit"></i> Edit User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>    
@stop

@section('content_body')
@if (session('success'))
    <div class="alert alert-success">
        <strong>{{ session('success') }}</strong>
    </div>
@endif
<div class="card">
  
    <div class="card-body">
        <p class="h5">Nombre</p>
        <p class="form-control">{{ $user->name }}</p>
        <h2 class="h5">Listado de roles</h2>
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                @foreach ($roles as $role)
                    <div>
                        <label>
                            <input 
                                type="checkbox" 
                                name="roles[]" 
                                value="{{ $role->id }}" 
                                class="mr-1"
                                {{ $user->roles->contains($role->id) ? 'checked' : '' }}
                            >
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>

    </div>
</div>  

{{-- Modal --}}
{{--  @include('admin.users.partials.modal') --}}

   
@stop

@push('css')
    
@endpush
   

@push('js')
    <script>
        window.routes = {
          /*   storeVehicle: "{{ route('admin.vehicles.store') }}" ,*/
            /* usersList: "{{ route('admin.users.list') }}" */
           /*  deleteVehicle: "{{ url('admin/vehicles') }}"  */
        };
/* 
        function previewImage(event, querySelector){
            //Recuperamos el input que desencadeno la acción
            let input = event.target;
            //Recuperamos la etiqueta img donde cargaremos la imagen
            let imgPreview = document.querySelector(querySelector);
            // Verificamos si existe una imagen seleccionada
            if(!input.files.length) return
            //Recuperamos el archivo subido
            let file = input.files[0];
            //Creamos la url
            let objectURL = URL.createObjectURL(file);
            //Modificamos el atributo src de la etiqueta img
            imgPreview.src = objectURL;
                        
        }
 */
    </script>
  {{--  @vite(['resources/js/pages/user.js'])  --}}
@endpush
