<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h1>
                {name} <a href="/teachers/{id}#start" id="start"><i class="fas fa-user"></i></a>
            </h1>
            <p class="lead mb-5">
                Страница преподавателя. Здесь вы можете прочитать подробнее о карьере преподавателя и его студентах.
            </p>
        </div>
        <div class="col-auto d-none d-sm-block">
            <img src="{foto}" width="140px" height="140px" class="bg-primary rounded-circle d-block mx-auto p-1" alt="" />
        </div>
    </div>

    <h4 class="mb-5 text-center border-left py-4"><span class="text-primary">П</span>рофиль</h4>

    <h4><span class="text-primary">Идентификатор (ID)</span> -</h4>
    <p>ID для этого преподавателя - <b>{id}</b></p>

    <h4><span class="text-primary">Б</span>иография -</h4>
    <p>{biography}</p>

    <h4><span class="text-primary">С</span>таж -</h4>
    <p>
        Стаж преподавания - <b>{experience}</b>. <br />
        Стаж преподавателя рассчитываеться как время прошедшее с даты начала карьеры - {experience-start}
    </p>

    [students]

    <h4 class="my-5 text-center border-left py-4"><span class="text-primary">C</span>писок студентов</h4>
    <p>{students}</p>

    [/students]

    <p>Вернуться на <a href="/teachers">страницу преподавателей</a></p>
</div>
