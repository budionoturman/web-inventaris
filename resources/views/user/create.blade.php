@extends('layouts/layout')
@section('container')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title fw-semibold mb-4">Form Penambahan User</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="/users" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama </label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">username </label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">pasword </label>
                                <input type="text" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="number" class="form-control" name="nip" id="nip">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="number" class="form-control" name="no_hp" id="no_hp" required>
                            </div>
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-control selectrole select2" id="role_id selectrole" name="role_id"
                                    required>
                                    @foreach ($roles as $role)
                                        @if (old('roles_id') == $role->id)
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
