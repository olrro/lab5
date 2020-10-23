<div class="dropdown">
<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  {username}
</button>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
  <a class="dropdown-item" href="/profile">Профиль</a>
  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exitModal">Выход</a>
</div>
</div>

<div class="modal fade" id="exitModal" tabindex="-1" role="dialog" aria-labelledby="exitModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exitModalLabel">Выход</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы действительно хотите выйти из своего аккаунта?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Назад</button>
        <a href="/logout" type="button" class="btn btn-primary">Выйти</a>
      </div>
    </div>
  </div>
</div>
