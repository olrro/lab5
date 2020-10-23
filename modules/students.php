<?php

/*
=====================================================
 Страница со списком студентов
 -------------------------------------
 Файл: students.php
=====================================================
*/

#Если отправлена подстраница - выводим профиль студента
if ( isset( $system['subdata'] ) ) {

  $query = $database->prepare( 'SELECT * FROM students WHERE id = :id' );
  $query->execute( ['id' => intval( $system['subdata'] )] );

  $row = $query->fetch();

  if ( $row['id'] ) {

    $tpl = new Template;

    $tpl->load('students.student.tpl')
    ->set( '{id}', $row['id'] )
    ->set( '{gender}', returnGender( $row['gender'] ) )
    ->set( '{birthday}', $row['birthday'] )
    ->set( '{foto}', '/template/images/database/' . $row['photo'] )
    ->set( '{name}', $row['name'] );

    $page = $tpl->compile();

  }
  else {

    # Отдаем 404 и информацию об ошибке
    header( 'HTTP/1.1 404 Not Found' );

    $page = returnInformationBox(
      'Ничего не найдено',
      'Похоже, что данной страницы не существует, либо она скрыта для вас. Перейти на <a href="/">главную</a> страницу',
      'fas fa-search'
    );

  }

}
else {
  
  #Если подстраница не отправлена - выводим список студентов
  $tpl = new Template;
  $page = $tpl->load('students.tpl')->compile();

}

 ?>
