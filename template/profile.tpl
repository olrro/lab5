<div class="container">
    <h1 class="mt-5">
        Мой профиль <a href="/profile#start" id="start"><i class="fas fa-user"></i></a>
    </h1>
    <p class="lead">Добро пожаловать в ваш профиль. Здесь вы можете редактировать информацию о себе и изменять некоторые параметры в учебе.</p>

    <div class="row mt-5">
        <div class="col-xl-4 mb-4a">
            <div class="border p-3 rounded">
                <div class="text-center">
                    <div class="position-relative d-inline-block">
                        <img src="/template/images/avatar.jpg" width="140px" height="140px" class="bg-primary rounded-circle d-block mx-auto my-2 p-1" alt="" />
                        <i class="fas fa-check align-items-center text-center justify-content-center position-absolute text-white align-baseline bg-primary d-inline-flex rounded-circle"
                            style="right: 0; white-space: nowrap; bottom: 20px; width: 2rem; height: 2rem;"
                        ></i>
                    </div>
                </div>
                <h4 class="text-center">{username}</h4>
            </div>
            <ul class="list-group my-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Группа</h6>
                        <small class="text-muted">Студент / Профессия - Аналитик</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Дата начала обучения</h6>
                        <small class="text-muted">12.06.2019 (238 дней с нами)</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Баланс</span>
                    <strong>13 586 <i class="fas fa-ruble-sign"></i> </strong>
                </li>
            </ul>

            <div class="btn-group w-100 mb-3" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Действия
                </button>
                <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="/manager">Открыть управление объектами</a>
                    <a class="dropdown-item" href="#">История</a>
                    <a class="dropdown-item" href="#">Новый курс</a>
                    <a class="dropdown-item" href="#">Мой рейтинг</a>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-3 mb-lg-5">
                <h5 class="card-header">Настройки</h5>

                <div class="card-body">
                    <div class="row form-group">
                        <label for="fullname" class="col-sm-3 col-form-label input-label">
                            Имя &amp; Email
                        </label>

                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Алеша Лепехин" value="{name}" />
                                <input type="text" class="form-control" name="email" id="email" placeholder="admin@lab.ru" value="{email}" />
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-sm-3 col-form-label input-label">О себе</label>

                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-signature"></i>
                                    </span>
                                </div>
                                <textarea class="form-control" id="info" placeholder="Напишите рассказ о себе в несколько предложений" name="info" rows="10" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />

                    <div class="row form-group">
                        <label for="altpass" class="col-sm-3 col-form-label input-label">Текущий пароль</label>

                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" name="altpass" id="altpass" placeholder="Введите текущий пароль" />
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="password1" class="col-sm-3 col-form-label input-label">Новый пароль</label>

                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" name="password1" id="password1" placeholder="Введите новый пароль" />
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="password2" class="col-sm-3 col-form-label input-label">Подтвердите новый пароль</label>

                        <div class="col-sm-9">
                            <div class="mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Подтвердите пароль" />
                                </div>
                            </div>

                            <h5>Рекомендации по паролю:</h5>

                            <p class="card-text font-size-1">Пароль должен включать в себя:</p>

                            <ul class="font-size-1">
                                <li>Минимум 8 символов</li>
                                <li>Как минимум 1 символ в верхнем регистре</li>
                                <li>Как минимум 1 символ в нижнеи регистре</li>
                                <li>Как минимум 1 специальный символ</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-lg btn-primary w-100" name="button">Сохранить</button>
        </div>
    </div>
</div>
