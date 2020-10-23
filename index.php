<?php

/*
=====================================================
 Главный обработчик
 -------------------------------------
 Файл: index.php
=====================================================
*/

error_reporting(1);

date_default_timezone_set ( 'Europe/Moscow' );

mb_internal_encoding( 'UTF-8' );

define( 'ROOT_DIR', __DIR__ );

# Подключаем все требуемые файлы
require ROOT_DIR . '/config/db.php';
require ROOT_DIR . '/modules/functions.php';
require ROOT_DIR . '/classes/template.class.php';

# Начинаем сессию
session_start();

# Проверяем авторизован ли пользователь и выдергиваем информацию о нем из базы
if ( isset( $_SESSION['logged_user'] ) ) {

    $user_data = $database->prepare( 'SELECT * FROM users WHERE id = :id' );
    $user_data->execute([ 'id' => intval( $_SESSION['logged_user'] ) ]);
    $user_data = $user_data->fetch();

}

$system = [];

$system['page'] = $_GET['page'];

if ( isset( $_GET['subdata'] ) ) {
  $system['subdata'] = $_GET['subdata'];
}

if ( isset( $_GET['subpage'] ) ) {
  $system['subpage'] = $_GET['subpage'];
}

# Начинаем строить главный шаблон
$cover_tpl = new Template;
$cover_tpl->load( 'cover.tpl' );

# Обработчик страниц
if ( !empty( $system['page'] ) ) {

  switch ( $system['page'] ) {

    case 'login':

      require_once ROOT_DIR . '/modules/login.php';

    break;

    case 'profile':

      require_once ROOT_DIR . '/modules/profile.php';

    break;

    case 'logout':

      # Разрушаем сесси при выходе из аккаунта
      if ( isset( $_SESSION['logged_user'] ) ) {
        unset( $_SESSION['logged_user'] );
        header('Location: /');
        exit();
      }
      else {
        header('HTTP/1.1 403 Forbidden');
        header('Location: /');
        exit();
      }

    break;

    case 'items':

      $tpl = new Template;
      $page = $tpl->load('items.tpl')->compile();

    break;

    case 'rating':

      $tpl = new Template;
      $page = $tpl->load('rating.tpl')->compile();

    break;

    case 'students':

      require ROOT_DIR . '/modules/students.php';

    break;

    case 'teachers' :

      require ROOT_DIR . '/modules/teachers.php';

    break;

    case 'manager' :

      require ROOT_DIR . '/modules/manager.php';

    break;

    case 'search':

    require ROOT_DIR . '/modules/search.php';

    $tpl = new Template;

    $tpl->load( 'search.tpl' );

    if ( $search_results ) {
      $tpl->set( '{results}', $search_results );
    }
    else {
      $tpl->set( '{results}', '' );
    }

    $page = $tpl->compile();

    break;

    default:

      # Отдаем 404 и информацию об ошибке
      header( 'HTTP/1.1 404 Not Found' );

      $page = returnInformationBox(
        'Ничего не найдено',
        'Похоже, что данной страницы не существует, либо она скрыта для вас. Перейти на <a href="/">главную</a> страницу',
        'fas fa-search'
      );

    break;

  }

}
else {

  # Если нет страницы то выводим главную
  $body = new Template;
  $page = $body->load('main.tpl')->compile();

}

$cover_tpl->set( '{login}', returnPopUpProfile() );
$cover_tpl->set( '{body}', $page );

$main = $cover_tpl->compile();

# Выводим результат
echo $main;


 ?>
