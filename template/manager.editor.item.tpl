[teacher]
<div class="media border-left border-separator pl-3 mb-5">
    <img class="bg-primary rounded-circle p-1 mr-3" src="{foto}" width="60px" height="60px" alt="" />
    <div class="media-body d-flex">
        <div>
            <a class="text-decoration-none" href="/teachers/{id}" target="_blank"><h5 class="mt-0">{name} (Наставник)</h5></a>
            Стаж преподавания - <b>{experience}</b> <br />
            {biography}
        </div>
        <div class="ml-auto">
            <a href="/manager/teacher/{id}">
                <button class="btn btn-outline-primary w-100 h-100 shadow" type="button"><i class="fas fa-cog fa-sm"></i></button>
            </a>
        </div>
    </div>
</div>
[/teacher]
[student]
<div class="media border-left border-separator pl-3 mb-5">
    <img class="bg-primary rounded-circle p-1 mr-3" src="{foto}" width="60px" height="60px" alt="" />
    <div class="media-body d-flex">
        <div>
            <a class="text-decoration-none" href="/students/{id}" target="_blank"><h5 class="mt-0">{name} (Ученик)</h5></a>
            Дата рождения студента - <b>{birthday}</b> <br />
            Пол - <b>{gender}</b>
        </div>
        <div class="ml-auto">
            <a href="/manager/student/{id}">
                <button class="btn btn-outline-primary w-100 h-100 shadow" type="button"><i class="fas fa-cog fa-sm"></i></button>
            </a>
        </div>
    </div>
</div>
[/student]
