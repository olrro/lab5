<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1>
                {name} <a href="/students/{id}#start" id="start"><i class="fas fa-user"></i></a>
            </h1>
            <p class="lead mb-5">
                Страница студента. Приведена краткая информация о студенте и его статусе
            </p>
        </div>
        <div class="col-auto d-none d-sm-block">
            <img src="{foto}" width="140px" height="140px" class="bg-primary rounded-circle d-block mx-auto p-1" alt="" />
        </div>
    </div>

    <h4 class="mb-5 text-center border-left py-4"><span class="text-primary">П</span>рофиль</h4>

    <h4><span class="text-primary">Идентификатор (ID)</span> -</h4>
    <p>ID для этого студента - <b>{id}</b></p>

    <h4><span class="text-primary">П</span>ол -</h4>
    <p>{gender}</p>

    <h4><span class="text-primary">Д</span>ата рождения -</h4>
    <p>{birthday}</p>

    <p>Вернуться на <a href="/students">страницу студентов</a></p>
</div>
