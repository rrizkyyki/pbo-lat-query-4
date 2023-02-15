@extends('layouts.base')
@section('content')
@include('_partials.navbar')
@section('container')
    <div class="card">
        <div class="card-header">
            <h6>Form Masyarakat</h6>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form action="/" method="post">
                @csrf
                <div class="form-group">
                    <label for="nama_lengkap" class="form-label">Nama</label>
                    <input type="text" name="nama_lengkap" class="form-control">
                </div>
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control">
                </div>
                <button type="submit" class="btn btn-success mt-3">Kirim</button>
            </form>
        </div>
    </div>

    <table class="table table-striped table-bordered mt-3">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Username</th>
            <th scope="col">Telepon</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($masyarakat as $key => $get)
                <tr>
                    <th scope="row">{{$key + 1}}</th>
                    <td>{{$get->nama_lengkap}}</td>
                    <td>{{$get->username}}</td>
                    <td>{{$get->telepon}}</td>
                    <td>
                        <button class="btn btn-danger" data-bs-toggle="modal"  data-bs-target="#deleteModal{{$get->id_user}}">Hapus</button>
                    </td>
                </tr>

                {{-- Delete modal --}}
                <div class="modal fade" id="deleteModal{{$get->id_user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus {{$get->nama_lengkap}}
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="/edit/{{$get->id_user}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection
