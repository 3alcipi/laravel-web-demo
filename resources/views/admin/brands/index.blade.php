@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Marcas')
{{-- @section('content_header_title', 'Dashboard')
@section('content_header_subtitle', 'Marcas') --}}
@section('header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-fw  fa-tag"></i> Marcas
                <button class="btn btn-app bg-dark" type="button" data-toggle="modal" data-target="#brandModal">
                    <i class="fas fa-plus-circle"></i>Nuevo
                </button>
                </h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-fw fa-house-user"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw  fa-tag"></i> Marca</li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>

    
@stop

{{-- Content body: main page content --}}

@section('content_body')

<div class="card">
  
    <div class="card-body">
        <table id="tabelBrand" class="table table-bordered table-hover table-sm text-center">
            <thead class="bg-gradient">
                <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Marca</th>
                    <th>Creado en</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>  

{{-- Modal --}}
@include('admin.brands.partials.modal')
   
@stop

{{-- Push extra CSS --}}

@push('css')
    
@endpush
   

@push('js')
    <script>
        window.routes = {
            storeBrand: "{{ route('admin.brands.store') }}",
            brandsList: "{{ route('admin.brands.list') }}",
            deleteBrand: "{{ url('admin/brands') }}"
        };
    </script>
   @vite(['resources/js/pages/brand.js'])
@endpush


