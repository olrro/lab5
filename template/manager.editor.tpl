<div class="container">
    <h1 class="mt-5">
        Редактор <a href="/manager/editor#start" id="start"><i class="fas fa-highlighter"></i></a>
    </h1>
    <p class="lead mb-5">
        На данной странице вы можете редактировать объекты содержащиеся в базе данных
    </p>

    <form method="POST">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputType">Показать</label>
            </div>

            <select class="custom-select" name="editor_type" id="inputType">
                <option selected>--Выберите--</option>
                <option value="1">Показать список преподавателей</option>
                <option value="0">Показать список студентов</option>
            </select>

            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Обновить</button>
            </div>
        </div>
    </form>

    <h4 class="my-5 text-center border-left py-4 border-separator"><span class="text-primary">О</span>бъекты</h4>

    {results} [not-found]
    <div class="d-flex justify-content-center align-items-center my-5">
        <i class="far display-4 fa-sad-cry"></i>
        <h5 class="ml-3">Ничего не найдено</h5>
    </div>
    [/not-found]

    <a href="/manager" class="btn btn-lg btn-outline-primary w-100 mb-4 animate__animated animate__headShake"> <i class="fas fa-arrow-left"></i> </a>

    <p>Вернуться на <a href="/">главную страницу</a></p>
</div>
