<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Muhammad Hilman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('/assets/logo/logo-sekwapres.svg')}}" type="image/svg">
    <meta name="msapplication-navbutton-color" content="#ffffff" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#ffffff" />


    @yield('head')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/assets/app/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/icons/css/all.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/dist/css/color.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/dist/css/animated.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/dist/css/admin/panel.css') }}">
    <link rel="stylesheet" href="{{ url('/assets/dist/css/admin/color.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    @livewireStyles
</head>

<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-md navbar-light bg-light py-1">
            <div class="container-fluid">
                <button class="btn btn-default" id="btn-slider" type="button">
                    <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
                </button>
                <a class="navbar-brand me-auto text-danger" href="#">Dash<span class="text-warning">Board</span></a>
                <ul class="nav ms-auto">
                    <!-- <li class="nav-item dropstart">
                        <a class="nav-link text-dark ps-3" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fa fa-bell fa-lg py-2" aria-hidden="true"></i>
                            <span class="badge bg-danger">10</span>
                        </a>
                        <div class="dropdown-menu mt-2 pt-0" aria-labelledby="navbarDropdown">
                            <div class="d-flex p-3 border-bottom align-items-cente mb-2">
                                <i class="fa fa-bell me-3" aria-hidden="true"></i>
                                <span class="fw-bold lh-1">Notifikasi</span>
                            </div>
                            <a class="dropdown-item py-2 overflow-hidden text-truncate" href="#">
                                <p class="lh-1 mb-0 fw-bold">Sample</p>
                                <small class="content-text">Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit. Quia sint laboriosam in architecto earum.</small>
                            </a>
                        </div>
                    </li> -->
                    <li class="nav-item dropstart">
                        <a class="nav-link text-dark ps-3 pe-1" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            @if (auth('admin')->user()->avatar == 'sample-images.png')
                            <img src="{{ url('/assets/img/avatar/' . auth('admin')->user()->avatar) }}"
                                alt="{{auth('admin')->user()->username}}" class="img-user" width="64px" height="64px">
                            @else
                            <img src="{{ url('/assets/img/avatar/' . auth('admin')->user()->avatar) }}"
                                alt="{{auth('admin')->user()->username}}" class="img-user" width="64px" height="64px">
                            @endif
                        </a>
                        <div class="dropdown-menu mt-2 pt-0" aria-labelledby="navbarDropdown">
                            <div class="d-flex p-3 border-bottom mb-2">
                                @if (auth('admin')->user()->avatar == 'sample-images.png')
                                <img src="{{ url('/assets/img/avatar/' . auth('admin')->user()->avatar) }}"
                                    alt="{{auth('admin')->user()->username}}" class="img-user me-2" width="64px"
                                    height="64px">
                                @else
                                <img src="{{ url('/assets/img/avatar/' . auth('admin')->user()->avatar) }}"
                                    alt="{{auth('admin')->user()->username}}" class="img-user me-2" width="64px"
                                    height="64px">
                                @endif
                                <div class="d-block mt-1">
                                    <p class="fw-bold m-0 lh-1">{{auth('admin')->user()->username}}</p>
                                    <small>{{auth('admin')->user()->email}}</small>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                <i class="fa fa-user fa-lg me-3" aria-hidden="true"></i>Profile
                            </a>
                            <hr class="dropdown-divider">
                            <a class="btnLogout dropdown-item" href="#">
                                <i class="fa fa-sign-out fa-lg me-2" aria-hidden="true"></i>LogOut
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="slider slider-theme" id="sliders">
            <div class="slider-head">
                <div class="d-block p-3">
                    @if (auth('admin')->user()->avatar == 'sample-images.png')
                    <img src="{{ url('/assets/img/avatar/' . auth('admin')->user()->avatar) }}"
                        alt="{{auth('admin')->user()->username}}" class="slider-img-user mb-2" width="64px"
                        height="64px">
                    @else
                    <img src="{{ url('/assets/img/avatar/admin/' . auth('admin')->user()->avatar) }}"
                        alt="{{auth('admin')->user()->username}}" class="slider-img-user mb-2" width="64px"
                        height="64px">
                    @endif
                    <p class="fw-bold mb-0 lh-1 text-white">{{auth('admin')->user()->username}}</p>
                    <small class="text-white">{{auth('admin')->user()->email}}</small>
                </div>
            </div>
            <div class="slider-body px-1 pb-4">
                <nav class="nav flex-column" id="nav-acordion" role="tablist" aria-multiselectable="true">
                    <a class="nav-link px-3 active" href="{{ route('admin.index') }}">
                        <i class="fa fa-home box-icon" aria-hidden="true"></i>Dashboard
                    </a>
                    <a class="nav-link px-3" href="{{ route('admin.profile') }}">
                        <i class="fas fa-user box-icon" aria-hidden="true"></i>Profile
                    </a>
                    <hr class="soft my-1 text-white">
                    <a class="nav-link px-3" href="">
                        <i class="fas fa-info-circle box-icon" aria-hidden="true"></i>Permintaan
                    </a>
                    <a class="nav-link px-3" href="#user" type="button" data-bs-toggle="collapse" data-bs-target="#user">
                        <i class="fas fa-users box-icon fa-fw"></i>Users
                        <span class="indications">
                            <i class="fas fa-angle-down fa-sm fa-fw"></i>
                        </span>
                    </a>
                    <div id="user" class="accordion-collapse collapse" data-bs-parent="#nav-accordion">
                        <a class="nav-link ps-4" href="">
                            <i class="fas fa-user-tie box-icon text-center"></i>Penanggung Jawab
                        </a>
                        <a class="nav-link ps-4" href="">
                            <i class="fas fa-users box-icon text-center fa-fw "></i>Pendamping
                        </a>
                    </div>
                    <a class="nav-link px-3" href="">
                        <i class="fas fa-car box-icon" aria-hidden="true"></i>Kendaraan
                    </a>
                    <hr class="soft my-1 text-white">
                    <a class="btnLogout nav-link px-3" href="#">
                        <i class="fas fa-sign-out-alt box-icon"></i>LogOut
                    </a>
                </nav>
            </div>
        </div>

        <div class="main-pages">
            @yield('pages')
        </div>
    </div>

    <div class="slider-background" id="sliders-background"></div>
    <script src="{{ url('/assets/dist/js/jquery.js') }}"></script>
    <script src="{{ url('/assets/dist/js/popper.js') }}"></script>
    <script src="{{ url('/assets/app/js/app.js') }}"></script>
    <script src="{{ url('/assets/dist/js/alert.js') }}"></script>
    <script src="{{ url('/assets/dist/js/admin/panel.js') }}"></script>
    <script src="{{ asset('/assets/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('/assets/owl/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    @livewireScripts
    @yield('script')

    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session()->get("success") }}',
        })
    </script>
    @elseif(session()->has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Maaf',
            text: '{{ session()->get("error") }}',
        })
    </script>
    @endif
</body>

</html>