<?php

/*
=====================================================
 Вывод списка учителей из базы
 -------------------------------------
 Файл: teachers.php
=====================================================
*/

#Если не отправлена подстраница - выводим список преподавателей
if ( !isset( $system['subdata'] ) ) {

  $query = $database->prepare( 'SELECT * FROM teachers' );
  $query->execute();

  $results = [];

  $tpl = new Template;

  while ( $row = $query->fetch() ) {

    $results[] = $tpl->load('teacher.item.tpl')
    ->set( '{name}', $row['name'] )
    ->set( '{experience}', yearSuffix( strtotime( $row['experience'] ) ) )
    ->set( '{bio}', $row['biography'] )
    ->set( '{id}', $row['id'] )
    ->set( '{photo}', '/template/images/database/' . $row['photo'] )
    ->compile();

  }

  #Если список собран и не пуст
  if ( $results ) {

    $page = $tpl->load('teachers.tpl')
    ->set( '{teachers}', implode( "", $results ) )
    ->compile();

  }
  else {

    $page = returnInformationBox(
      'Преподаватели потерялись',
      'Похоже, что пока наш список преподавателей пуст. Зайдите чуть позже, когда мы обновим нашу информацию. Перейти на <a href="/">главную</a> страницу',
      'fas fa-heart-broken'
    );

  }

}
else {

  #Если отправлена подстраница - выводим профиль преподавателя

  $teacher_id = intval( $system['subdata'] );

  $query = $database->prepare( 'SELECT * FROM teachers WHERE id = ?' );
  $query->execute( [ $teacher_id ] );

  if ( $row = $query->fetch() ) {

    $tpl = new Template;

    #Собираем шаблон профиля преподавателя
    $tpl->load('teacher.full.tpl')
    ->set( '{name}', $row['name'] )
    ->set( '{biography}', $row['biography'] )
    ->set( '{experience-start}', $row['experience'] )
    ->set( '{id}', $row['id'] )
    ->set( '{experience}', yearSuffix( strtotime( $row['experience'] ) ) )
    ->set( '{foto}', '/template/images/database/' . $row['photo'] );

    $query = $database->prepare( 'SELECT * FROM students WHERE teacher_id = ?' );
    $query->execute( [ $teacher_id ] );

    $results = [];

    $student = new Template;

    while ( $row = $query->fetch() ) {

      #Собираем шаблон списка студентов, под руководством преподавателя
      $student->load('teacher.student.tpl')
      ->set( '{name}', $row['name'] )
      ->set( '{id}', $row['id'] )
      ->set( '{gender}', returnGender( $row['gender'] ) )
      ->set( '{foto}', '/template/images/database/' . $row['photo'] )
      ->set( '{birthday}', $row['birthday'] );

      $results[] = $student->compile();

    }

    #Если список собран и не пуст
    if ( $results ) {

      $tpl->set( '{students}', implode( "", $results ) )->set( '[students]', '' )
      ->set( '[/students]', '' );

    }
    else {

      $tpl->block( "'\\[students\\](.*?)\\[/students\\]'si", "" )
      ->set( '{students}', '' );

    }

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


 ?>
