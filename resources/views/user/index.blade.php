@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">

                        {{-- @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif --}}

                        <div class="d-flex inline justify-content-between">
                            <h5 class="card-title fw-semibold mb-4">Tabel Data User</h5>

                            @canany(['isKepalaStaff', 'isStaffGudang'])
                                <button type="button" class="btn btn-outline-secondary m-1">
                                    <a href="/users/create">Tambah</a>
                                </button>
                            @endcanany
                        </div>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama User</th>
                                        <th>NIP</th>
                                        <th>No. HP</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->nip }}</td>
                                            <td>{{ $user->no_hp }}</td>
                                            <td>{{ $user->role->role_name }}</td>
                                            <td class="d-flex inline">
                                                <a href="/users/{{ $user->id }}/edit">
                                                    <button type="button" class="btn btn-outline-warning m-1"><i
                                                            class="fa-solid fa-pen-to-square"></i></button>
                                                </a>
                                                <form action="/users/{{ $user->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger m-1"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </form>
                                                @if ($user->role_id == 4)
                                                    <a href="/users/{{ $user->id }}">
                                                        <button type="button" class="btn btn-outline-success m-1"><i
                                                                class="fa-solid fa-eye"></i></button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
