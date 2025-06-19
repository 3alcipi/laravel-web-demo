@extends('layouts.app')
@section('subtitle', 'Vehículos')
@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-car"></i> Vehículos                
                </h1>
                @can('admin.vehicles.store')
                    {{-- Button to open modal --}}
                    <button class="btn btn-app bg-dark" type="button" data-toggle="modal" data-target="#vehicleModal">
                        <i class="fas fa-plus-circle"></i>Nuevo
                    </button>
                @endcan
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-fw fa-house-user"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-car"></i> Vehículos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>    
@stop

@section('content_body')

<div class="card">
  
    <div class="card-body">
        <table id="tableVehicle" class="table table-bordered table-hover table-sm text-center">
            <thead class="bg-gradient">
                <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Placa</th>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Año</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>  

{{-- Modal --}}
@include('admin.vehicles.partials.modal')
@include('admin.vehicles.partials.viewModal')
   
@stop

@push('css')
    
@endpush
   

@push('js')
    <script>
        window.routes = {
            storeVehicle: "{{ route('admin.vehicles.store') }}",
            vehiclesList: "{{ route('admin.vehicles.list') }}",
            deleteVehicle: "{{ url('admin/vehicles') }}" 
        };

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

    </script>
   @vite(['resources/js/pages/vehicle.js'])
@endpush
