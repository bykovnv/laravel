@extends('layouts.profile')
@section('content')
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-lock'></i> Безопасность
    </h1>
</div>
<form action="/security/{{ $user->id }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Сбросить новый пароль на почту</h2>
                    </div>
                    <div class="panel-content">
                        <!-- email -->
                        <div class="form-group">
                            <label class="form-label" for="simpleinput">Email</label>
                            <input type="email" name="email" id="simpleinput" class="form-control" value="{{ $user->email }}">
                        </div>




                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                            <button class="btn btn-warning">Отправить новый пароль</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection
