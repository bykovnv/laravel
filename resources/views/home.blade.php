@extends('layouts.profile')

@section('content')



    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-user'></i> Профиль пользователя
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-6 col-xl-6 m-auto">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
        @endif
            <!-- profile summary -->
            <div class="card mb-g rounded-top">
                <div class="row no-gutters row-grid">
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                        <span class="status status-success mr-3">
                            <img src="/img/demo/avatars/avatar-a.png" alt="" class="img-responsive" width="200">
                        </span>
                            <h5 class="mb-0 fw-700 text-center mt-3">

                                <small class="text-muted mb-0"> </small>
                            </h5>
                            <div class="mt-4 text-center demo">
                                <a href="javascript:void(0);" class="fs-xl" style="color:#C13584">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="javascript:void(0);" class="fs-xl" style="color:#4680C2">
                                    <i class="fab fa-vk"></i>
                                </a>
                                <a href="javascript:void(0);" class="fs-xl" style="color:#0088cc">
                                    <i class="fab fa-telegram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 text-center">
                            <a href="tel:" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mobile-alt text-muted mr-2"></i> 8 495 123 -45 -67</a>
                            <a href="mailto:{{ Auth::user()->email }}" class="mt-1 d-block fs-sm fw-400 text-dark">
                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> {{ Auth::user()->email }} </a>
                            <address class="fs-sm fw-400 mt-4 text-muted">
                                <i class="fas fa-map-pin mr-2"></i> г. Москва ул. Тверская д 13
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
