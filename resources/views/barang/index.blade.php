@extends('layouts.base')
@section('content')
@include('_partials.navbar')
@section('container')

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <button data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success float-end mb-3">Add</button>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Harga Awal</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($barang as $get)
                <tr>
                    <th scope="row">{{$get->id_barang}}</th>
                    <td>{{$get->nama_barang}}</td>
                    <td>{{$get->tanggal}}</td>
                    <td>{{$get->harga_awal}}</td>
                    <td>{{$get->deskripsi_barang}}</td>
                    @if ($get->status_barang == 0)
                        <td><p class="bg-warning text-center rounded">Belum Terjual</p></td>
                    @else
                        <td><p class="bg-success text-center text-white rounded">Terjual</p></td>
                    @endif
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#editModal{{$get->id_barang}}" class="btn btn-warning">Edit</button>
                        <button data-bs-toggle="modal" data-bs-target="#deleteModal{{$get->id_barang}}" class="btn btn-danger">Hapus</button>
                    </td>
                </tr>

                {{-- Delete modal --}}
                <div class="modal fade" id="deleteModal{{$get->id_barang}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus {{$get->nama_barang}}
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="barang/edit/{{$get->id_barang}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{$get->id_barang}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Barang Lelang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="barang/edit/{{$get->id_barang}}" method="post" class="form">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id_barang" value="{{$get->id_barang}}">
                                <div class="form-group">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" name="nama_barang" value="{{$get->nama_barang}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" value="{{$get->tanggal}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="harga_awal" class="form-label">Harga</label>
                                    <input type="number" name="harga_awal" value="{{$get->harga_awal}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="deksripsi_barang" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi_barang" class="form-control" placeholder="Tuliskan deksripsi" id="floatingTextarea">{{$get->deskripsi_barang}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="deksripsi_barang" class="form-label">Status</label>
                                    <input type="number" class="form-control" name="status_barang" value="{{$get->status_barang}}">
                                </div>
                                <br>
                                <div class="float-end">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang Lelang</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('barang.store')}}" method="post" class="form">
                    @csrf
                    <div class="form-group">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="harga_awal" class="form-label">Harga</label>
                        <input type="number" name="harga_awal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deksripsi_barang" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi_barang" class="form-control" placeholder="Tuliskan deksripsi" id="floatingTextarea"></textarea>
                    </div>
                    <input type="hidden" name="status_barang" value="0">
                    <br>
                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

@endsection
