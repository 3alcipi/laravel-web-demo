@extends('layouts.app')
@section('subtitle', 'Reservación')
@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-vote-yea"></i> Reservaciones                
               
                @can('admin.vehicles.store')
                    {{-- Button to open modal --}}
                    <button class="btn btn-app bg-dark" type="button" data-toggle="modal" data-target="#reservationModal">
                        <i class="fas fa-plus-circle"></i>Nuevo
                    </button>
                @endcan
                </h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-fw fa-house-user"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-vote-yea"></i> Reservación</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>    
@stop

@section('content_body')

<div class="card">
  
    <div class="card-body">
        <table id="tableReservation" class="table table-bordered table-hover table-sm text-center">
            <thead class="bg-gradient">
                <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Nro.Doc</th>
                    <th>Telefono</th>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>                    
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>  

{{-- Modal --}}
@include('admin.reservations.partials.modal')
{{-- @include('admin.Vehicles.partials.viewModal') --}}
   
@stop

@push('css')
    
@endpush
   

@push('js')
    <script>
        window.routes = {
            /* storeVehicle: "{{ route('admin.vehicles.store') }}", */
            reservationsList: "{{ route('admin.reservations.list') }}"
           /*  deleteVehicle: "{{ url('admin/vehicles') }}"  */
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
  @vite(['resources/js/pages/reservation.js'])
@endpush
