<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Akmal</title>
    <style>
        body {
            background-color: lightgray !important;
        }

        </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@extends('layouts.admin')
<body>
    @section('content')
   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Data Kasir</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-kasir">TAMBAH</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody id="table-kasirs">
                    @foreach($kasirs as $kasir)
                    <tr id="index_{{ $kasir->id }}">
                        <td>{{ $kasir->nama }}</td>
                        <td>{{ $kasir->alamat }}</td>
                        <td>{{ $kasir->telp }}</td>
                        <td>{{ $kasir->email }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-kasir" data-id="{{ $kasir->id }}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-kasir" data-id="{{ $kasir->id }}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    @include('kasir.create') 
    @include('kasir.delete') 
    @include('kasir.edit') 
    @endsection
</body>
</html>