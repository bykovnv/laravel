
@extends('layouts.profile')

@section('content')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-image'></i> Загрузить аватар {{ $user->name }}
        </h1>

    </div>



     <form action="/media/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-xl-6">
                <div id="panel-1" class="panel">
                    <div class="panel-container">
                        <div class="panel-hdr">
                            <h2>Текущий аватар</h2>
                        </div>
                        <div class="panel-content">
                            <div class="form-group">
                                @isset($user->profile)
                                    <img src="/{{ $user->profile->image }}" alt="" class="img-responsive" width="200">
                                @endisset
                                @empty($user->profile)
                                    <img src="/img/demo/avatars/avatar-m.png" alt="" class="img-responsive" width="200">
                                @endempty
                            </div>

                            <div class="form-group">
                                <div class="h2"> {{ $errors->first('image') }} </div>
                                <label class="form-label" for="example-fileinput">Выберите аватар</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>


                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button class="btn btn-warning">Загрузить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection


