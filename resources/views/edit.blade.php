
@extends('layouts.profile')

@section('content')
<div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Редактировать пользователя {{ $user->id }}
            </h1>

        </div>
        <form method="POST" action="/edit/{{ $user->id }}">
            @csrf
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- id -->
                                <div class="form-group">
                                    <input name="id" type="hidden" id="simpleinput" class="form-control" value="{{ $user->id }}">
                                </div>
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Имя</label>
                                    <input name="name" type="text" id="simpleinput" class="form-control" value="{{ $user->name }}">
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Место работы  </label>
                                    <input name="company" type="text" id="simpleinput" class="form-control" value=" @isset($user->profile)
                                    {{ $user->profile->company }}
                                    @endisset
                                    @empty($user->profile)
                                        Компания не указана
@endempty">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Номер телефона</label>
                                    <input name="phone" type="text" id="simpleinput" class="form-control" value="@isset($user->profile)
                                    {{ $user->profile->phone }}
                                    @endisset">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Адрес</label>
                                    <input name="adress" type="text" id="simpleinput" class="form-control" value="@isset($user->profile)
                                    {{ $user->profile->adress }}
                                    @endisset
                                    @empty($user->profile)
                                        адрес еще не указан
@endempty">
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Редактировать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

@endsection


