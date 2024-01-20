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

<body>
<h1 class="h3 mb-2 text-gray-800">Data Pembeli</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-pembeli">TAMBAH</a>
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
                <tbody id="table-pembelis">
                    @foreach($pembelis as $pembeli)
                    <tr id="index_{{ $pembeli->id }}">
                        <td>{{ $pembeli->nama }}</td>
                        <td>{{ $pembeli->alamat }}</td>
                        <td>{{ $pembeli->tlp }}</td>
                        <td>{{ $pembeli->email }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-pembeli" data-id="{{ $pembeli->id }}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-pembeli" data-id="{{ $pembeli->id }}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('pembelis.create') 
@include('pembelis.edit') 
@include('pembelis.delete')
</body>
</html>