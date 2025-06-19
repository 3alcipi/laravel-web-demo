@extends('layouts.app')
@section('subtitle', 'Precios')
@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="far fa-money-bill-alt"></i> Precios
                <button class="btn btn-app bg-dark" type="button" data-toggle="modal" data-target="#priceModal">
                    <i class="fas fa-plus-circle"></i>Nuevo
                </button>
                </h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-fw fa-house-user"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="far fa-money-bill-alt"></i> Precios</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>    
@stop
@section('content_body')

<div class="card">
  
    <div class="card-body">
        <table id="tablePrice" class="table table-bordered table-hover table-sm text-center">
            <thead class="bg-gradient">
                <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Placa</th>
                    <th>Modelo</th>
                    <th>Precio por día</th>
                    <th>Fecha de Creación</th>
                    <th>Usado en Alqui.</th>
                    <th>Status</th>
                    
                    
                </tr>
            </thead>
        </table>
    </div>
</div>  

{{-- Modal --}}
@include('admin.prices.partials.modal') 
   
@stop
@push('css')
    
@endpush
   

@push('js')
    <script>
        window.routes = {
            storePrice: "{{ route('admin.prices.store') }}",
            pricesList: "{{ route('admin.prices.list') }}",
            //deleteBrand: "{{ url('admin/brands') }}"
        };
    </script>
   @vite(['resources/js/pages/price.js'])
@endpush


