<div class="container">
    <form class="form-signin" method="POST">
        <h1 class="h1 my-5 mt-2">Вход</h1>

        <label for="inputEmail" class="sr-only">Email</label>
        <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Введите логин" required autofocus autocomplete="off" />

        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Введите пароль" required autocomplete="off" />

        <div class="checkbox my-3">
            <label> <input type="checkbox" value="remember-me" /> Чужой компьютер </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        <p class="mt-5 mb-1 text-muted">&copy; 2017-2020 - CourseBox</p>
    </form>
</div>

<style media="screen">
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
