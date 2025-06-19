@extends('layouts.app')

@section('subtitle', 'Tipos')

@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-indent"></i> Tipos de vehículos
                <button class="btn btn-app bg-dark" type="button" data-toggle="modal" data-target="#typeModal">
                    <i class="fas fa-plus-circle"></i>Nuevo
                </button>
                </h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-fw fa-house-user"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-indent"></i> Tipo</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    
@stop

@section('content_body')

<div class="card">
  
    <div class="card-body">
        <table id="tableType" class="table table-bordered table-hover table-sm text-center">
            <thead class="bg-gradient">
                <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Creado en</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>  

{{-- Modal --}}
@include('admin.types.partials.modal')
   
@stop

@push('css')
    
@endpush
   

@push('js')
    <script>
        window.routes = {
            storeType: "{{ route('admin.types.store') }}", 
            typesList: "{{ route('admin.types.list') }}",
            deleteType: "{{ url('admin/types') }}"
        };
    </script>
   @vite(['resources/js/pages/type.js'])
@endpush