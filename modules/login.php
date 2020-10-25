<?php

/*
=====================================================
 Страница авторизации
 -------------------------------------
 Файл: login.php
=====================================================
*/

if ( !isset( $_SESSION['logged_user'] ) ) {

  # Если пользователь хочет авторизоваться
  if ( isset( $_POST['login'] ) AND isset( $_POST['password'] ) ) {

    $users = [ '55Ded' => 'test', 'Babushka' => 'test' ];

    foreach ( $users as $key => $value ) {

      if ( $_POST['login'] == $key ) {

        if ( $_POST['password'] == $users[$key] ) {

          # Ищем пользователя в базе
          $query = $database->prepare( 'SELECT id FROM users WHERE login = :login AND password = :password' );
          $query->execute([ 'login' => $key, 'password' => $users[$key] ]);

          if ( $query = $query->fetch() ) {

            # Успешная авторизация - редирект на главную страницу
            $_SESSION['logged_user'] = $query['id'];

            header('Location: /');
            exit();

          }
          else {
            $page = returnInformationBox(
              'Неудачный вход',
              'Произошла ошибка при подключении к базе данных. Пользователь не найден. Перейти на <a href="/">главную</a> страницу',
              'fas fa-plug'
            );
          }

        }
        else {

          $page = returnInformationBox(
            'Неудачный вход',
            'Похоже что вы ввели неправильный пароль. Перейти на <a href="/">главную</a> страницу',
            'fas fa-times-circle'
          );

        }

      }
      else {

        $page = returnInformationBox(
          'Неудачный вход',
          'Похоже что вы ввели неправильный логин. Перейти на <a href="/">главную</a> страницу',
          'fas fa-times-circle'
        );

      }
    }

  }
  else {

    # Выводит форму авторизации
    $tpl = new Template;
    $page = $tpl->load('login.tpl')->compile();

  }

}
else {

  $page = returnInformationBox(
    'Вы уже с нами',
    'Вы уже авторизованы на сайте. Перейти на <a href="/">главную</a> страницу',
    'fas fa-user-check'
  );

}






 ?>
