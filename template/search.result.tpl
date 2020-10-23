[found]
<a class="text-dark text-decoration-none" href="{link}" target="_blank">
    <div class="card flex-md-row mb-4">
        <div class="card-body d-flex flex-column align-items-start">
            <strong class="d-inline-block mb-2 text-primary">Результат № {number}</strong>
            <h5 class="mb-2">{title} <i class="fas fa-link text-primary"></i></h5>
            <p class="card-text mb-auto">{description} (текст может быть сокращен)</p>
        </div>
    </div>
</a>
[/found]
[not-found]
<div class="d-flex justify-content-center align-items-center my-5">
    <i class="far display-4 fa-sad-cry"></i>
    <h5 class="ml-3">{error}</h5>
</div>
[/not-found]
