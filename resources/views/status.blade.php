 @extends('layouts.profile')
 @section('content')
<div class="subheader">
    <h1 class="subheader-title">
        <i class='subheader-icon fal fa-sun'></i> Установить статус у пользователя <?php echo $user['name']; ?>
    </h1>

</div>

<form action="/status/{id}" method="post">
    @csrf
    <div class="row">
        <div class="col-xl-6">
            <div id="panel-1" class="panel">
                <div class="panel-container">
                    <div class="panel-hdr">
                        <h2>Установка текущего статуса пользователя  {{ $user->name }}</h2>
                    </div>
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- status -->
                                <div class="form-group">
                                    <label class="form-label" for="example-select">Выберите статус</label>
                                    <select class="form-control" id="example-select" name="status">
                                        <option value="online">Онлайн</option>
                                        <option value="away">Отошел</option>
                                        <option value="distrub">Не беспокоить</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                <button class="btn btn-warning">Установить статус</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
 @endsection
