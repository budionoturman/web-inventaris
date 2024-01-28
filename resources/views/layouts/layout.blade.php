<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMK Avicena | Inventaris Barang</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('admin-ui') }}/src/assets/images/logos/favicon.png" />
        <link rel="stylesheet" href="{{ asset('admin-ui') }}/src/assets/css/styles.min.css" />
        <script src="https://kit.fontawesome.com/41517c21c4.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Main style -->
        <link rel="stylesheet" href="{{ asset('css') }}/main.css?v=<?php echo time(); ?>">
        {{-- datatables --}}
        <link rel="stylesheet" href="{{ asset('admin-ui') }}/src/datatables/dataTables.bootstrap4.css">
    </head>

    <body>
        <!--  Body Wrapper -->
        <div class="page-wrapper shadow p-3 mb-5 bg-body-tertiary rounded" id="main-wrapper" data-layout="vertical"
            data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
            <!-- Sidebar Start -->
            <aside class="left-sidebar ">
                <!-- Sidebar scroll-->
                <div class="">
                    <div class="brand-logo d-flex align-items-center justify-content-between mt-3">
                        <a href="#" class="text-nowrap logo-img">
                            <img src="{{ asset('image/iconsmk.jpeg') }}" width="50" height="50" alt="" />
                            <span class="text-dark">SMK Avicena</span>
                        </a>
                        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                            <i class="ti ti-x fs-8"></i>
                        </div>
                    </div>

                    <!-- Sidebar Pegwai-->
                    @can('isPegawai')
                        <nav class="sidebar-nav text-white" data-simplebar="" style=" ">
                            <ul id="sidebarnav">
                                <li class="nav-small-cap">
                                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                    <span class="hide-menu">Home</span>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/home" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-layout-dashboard"></i>
                                        </span>
                                        <span class="hide-menu">Barang</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/pegawai/peminjams" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <span class="hide-menu">Peminjaman</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/pegawai/history" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                        </span>
                                        <span class="hide-menu">History</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    @endcan

                    <!-- Sidebar Non Pegawai-->
                    @canany(['isKepalaSekolah', 'isKepalaStaff', 'isStaffGudang'])
                        <nav class="sidebar-nav text-white" data-simplebar="" style=" ">
                            <ul id="sidebarnav">
                                <li class="nav-small-cap">
                                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                    <span class="hide-menu">Home</span>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/home" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-layout-dashboard"></i>
                                        </span>
                                        <span class="hide-menu">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/barangs" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-computer"></i>
                                        </span>
                                        <span class="hide-menu">Barang</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/users" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <span class="hide-menu">Data User</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        <span>
                                            <i class="ti ti-database"></i>
                                        </span>
                                        <span class="hide-menu">Data Master</span>
                                    </a>
                                    <div class="collapse" id="collapseExample">
                                        <div class="bg-white collapse-inner rounded ms-3">
                                            <a class="collapse-item sidebar-link mt-2" href="/kategoris">
                                                <span>
                                                    <i class="ti ti-article"></i>
                                                </span>
                                                <span class="hide-menu">Kategori</span>
                                            </a>
                                            <a class="collapse-item sidebar-link" href="/jurusans">
                                                <span>
                                                    <i class="ti ti-article"></i>
                                                </span>
                                                <span class="hide-menu">Jurusan</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>


                                <li class="nav-small-cap">
                                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                    <span class="hide-menu">Peminjaman & Pengembalian</span>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/peminjams" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <span class="hide-menu">Peminjaman</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/pengembalians" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-right-left"></i>
                                        </span>
                                        <span class="hide-menu">Pengembalian</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/history" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                        </span>
                                        <span class="hide-menu">History</span>
                                    </a>
                                </li>

                                <li class="nav-small-cap">
                                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                    <span class="hide-menu">Pengadaan</span>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/kondisi-barangs" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-computer"></i>
                                        </span>
                                        <span class="hide-menu">Kondisi Barang</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/pengadaans" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </span>
                                        <span class="hide-menu">Pengadaan Masuk</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/pengadaan/disetujui" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </span>
                                        <span class="hide-menu">Pengadaan Disetujui</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/pengadaan/dibeli" aria-expanded="false">
                                        <span>
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                        </span>
                                        <span class="hide-menu">Pengadaan Dibeli</span>
                                    </a>
                                </li>
                                {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-aperture"></i>
                                </span>
                                <span class="hide-menu">Sample Page</span>
                            </a>
                        </li> --}}
                            </ul>
                        </nav>
                    @endcanany
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!--  Sidebar End -->
            <!--  Main wrapper -->
            <div class="body-wrapper">
                <!--  Header Start -->
                <header class="app-header" style="margin-top: -16px; margin-left: -10px">
                    <nav class="navbar navbar-expand-lg navbar-light shadow rounded">
                        <ul class="navbar-nav">
                            <li class="nav-item d-block d-xl-none">
                                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                    href="javascript:void(0)">
                                    <i class="ti ti-menu-2"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                                {{-- <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a> --}}
                                <li>Nama : {{ auth()->user()->name }}, Role : {{ auth()->user()->role->role_name }}</li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('admin-ui') }}/src/assets/images/profile/user-1.jpg"
                                            alt="" width="35" height="35" class="rounded-circle">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                        aria-labelledby="drop2">
                                        <div class="message-body">
                                            {{-- <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a> --}}
                                            <form action="/logout" method="post">
                                                @csrf
                                                <button class="btn btn-outline-primary mx-3 mt-2 d-block">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <!--  Header End -->
                @yield('container')
            </div>

        </div>
        <script src="{{ asset('admin-ui') }}/src/assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('admin-ui') }}/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('admin-ui') }}/src/assets/js/sidebarmenu.js"></script>
        <script src="{{ asset('admin-ui') }}/src/assets/js/app.min.js"></script>
        <script src="{{ asset('admin-ui') }}/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
        <script src="{{ asset('admin-ui') }}/src/assets/libs/simplebar/dist/simplebar.js"></script>
        <script src="{{ asset('admin-ui') }}/src/assets/js/dashboard.js"></script>
        <script src="{{ asset('admin-ui') }}/src/datatables/jquery.dataTables.js"></script>
        <script src="{{ asset('admin-ui') }}/src/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('admin-ui') }}/src/datatables/datatables-demo.js"></script>
        {{-- Select2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <script type="text/javascript">
            $(function() {
                $('.select2').select2()
            });

            $(function() {
                $('#selectrole').select2({
                    placeholder: 'Select Role',
                    ajax: {
                        url: '/getrole',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.role_name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

            $(function() {
                $('#selectjurusan').select2({
                    placeholder: 'Select jurusan',
                    ajax: {
                        url: '/getjurusan',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.jurusan_name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

            $(function() {
                $('#selectkategori').select2({
                    placeholder: 'Select Kategori',
                    ajax: {
                        url: '/getkategori',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.kategori_name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

            $(function() {
                $('#selectpegawai').select2({
                    placeholder: 'Select Pegawai',
                    ajax: {
                        url: '/getpegawai',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

            $(function() {
                $('.selectbarang').select2({
                    placeholder: 'Select Barang',
                    ajax: {
                        url: '/getbarang',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.barang_name,
                                        id: item.id,
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });

            $(function() {
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var minDate = year + '-' + month + '-' + day;

                $('#tgl_pinjam').attr('min', minDate);
            });

            var path = "{{ url('peminjam/create/') }}";

            $('#search').typeahead({

                source: function(query, process) {

                    return $.get(path, {
                        query: query
                    }, function(data) {

                        return process(data);
                    });
                }
            });

            function resetForm() {
                document.getElementById("myForm").reset();
            }
        </script>

        <script>
            $('.cb').click(function() {
                $('.ul').html("");
                $(".cb").each(function() {
                    if ($(this).is(":checked")) {
                        var barangName = $(this).attr('placeholder');
                        $('.ul').append('<li>' + barangName + '</li>')
                    }
                });
            });
        </script>

        @if (session()->has('success'))
            <script type="text/javascript">
                $(document).ready(function() {
                    var message = "{{ session('success') }}"
                    alert(message);
                });
            </script>
        @endif

        <script>
            function myFunction() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("li");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("label")[0];
                    txtValue = a.textContent || a.innerText;
                    if (filter && txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                        const checkboxCollection = document.querySelectorAll('input[type="checkbox"]')
                        const checkboxArray = [...checkboxCollection];
                        checkboxArray.forEach(input => input.addEventListener('change', drawList))

                        drawList();
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
            myFunction()

            function drawList() {
                const list = document.getElementById('myUL');
                const itemArray = [...list.children];

                const sortedArray = itemArray.sort((a, b) => {
                    // First sort by checbox
                    let aChecked = a.querySelector('input').checked;
                    let bChecked = b.querySelector('input').checked;
                    if (aChecked && !bChecked) return -1;
                    if (!aChecked && bChecked) return 1;

                    // If both are checked/not checked compare by textContent
                    let aText = a.querySelector('label').textContent;
                    let bText = b.querySelector('label').textContent;
                    return aText > bText ? 1 : -1;
                })

                list.innerHTML = '';
                list.append(...sortedArray);
            }

            const checkboxCollection = document.querySelectorAll('input[type="checkbox"]')
            const checkboxArray = [...checkboxCollection];
            checkboxArray.forEach(input => input.addEventListener('change', drawList))

            drawList();
        </script>

    </body>

</html>
