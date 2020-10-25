<?php

/*
=====================================================
 Профиль пользователя
 -------------------------------------
 Файл: profile.php
=====================================================
*/

if ( isset( $_SESSION['logged_user'] ) ) {

  # Начинаем сборку шалона для профиля пользователя

  $tpl = new Template;

  $tpl->load( 'profile.tpl' )
  ->set( '{username}', $system['user_data']['login'] );

  if ( $system['user_data']['name'] ) {
    $tpl->set( '{name}', $system['user_data']['name'] );
  }
  else {
    $tpl->set( '{name}', '' );
  }

  if ( $system['user_data']['email'] ) {
    $tpl->set( '{email}', $system['user_data']['email'] );
  }
  else {
    $tpl->set( '{email}', '' );
  }

  $page = $tpl->set( '{info}', $info )
  ->compile();

}
else {

  # Если нет сессии, то запрещаем доступ к профилю

  $page = returnInformationBox(
    'Вы не авторизованы',
    'Чтобы использовать личный кабинет, необходимо авторизоваться. Перейти на <a href="/login">страницу авторизации</a>',
    'fas fa-lock'
  );

}

 ?>
