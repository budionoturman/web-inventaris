<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMK Avicena | Inventaris Barang</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('admin-ui') }}/src/assets/images/logos/favicon.png" />
        <link rel="stylesheet" href="{{ asset('admin-ui') }}/src/assets/css/styles.min.css" />
    </head>

    <body>
        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            <div
                class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-6 col-lg-6 col-xxl-6">
                            @if (session()->has('login_gagal'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('login_gagal') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <h3 class="text-center my-5">Sistem Informasi Inventaris Barang SMK Avicena</h3>
                                        <div class="col">
                                            <a href="#"
                                                class="text-nowrap logo-img text-center d-block py-3 w-100">
                                                <img src="{{ asset('image/iconsmk.jpeg') }}" width="300"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="col">
                                            <form action="/login" method="post">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="username" class="form-label">User name</label>
                                                    <input type="username"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        id="username" name="username" placeholder="Enter username">
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password" placeholder="Enter password">
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                                        In</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('admin-ui') }}/src/assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('admin-ui') }}/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
