<?php

/*
=====================================================
 Менеджер преподавателей (Добавление и редактирование наставников)
 -------------------------------------
 Файл: manager.teacher.php
=====================================================
*/

#Если пользователь хочет удалить преподавателя
if ( isset( $_POST['remove'] ) ) {

  if ( removeObject( $_POST['remove'], 'teachers') ) {

    $page = returnInformationBox(
      'Удалено',
      'Преподаватель был успешно удален! Вы можете перейти на <a href="/manager">страницу</a> с объектами',
      'fas fa-check-circle'
    );

  }
  else {

    $page = returnInformationBox(
      'Ошибка',
      'Преподавателя с таким ID не найдено. Пожалуйста, <a href="/manager">вернитесь</a> и обновите страницу',
      'fas fa-times-circle'
    );

  }

}
elseif ( isset( $_POST['name'] ) ) {

  #Если пользователь хочет добавить / редактировать преподавателя
  $params = [];

  if ( isset( $_POST['id'] ) ) {
     $params['id'] = intval( $_POST['id'] );
  }

  $params['date'] = strtotime( $_POST['date'] );

  if ( !$params['date'] ) {
    $error = 1;
  }
  else {

    if ( ( $params['date'] > strtotime( '2005-01-01' ) ) OR ( $params['date'] < strtotime( '1900-01-01' ) )  ) {
      $error = 1;
    }
    else {
      $params['date'] = date( "Y-m-d", $params['date'] );
    }

  }

  if ( !preg_match( '/^[а-яА-ЯЁёA-Za-z\s]+$/iu', $_POST['name'] ) OR mb_strlen( $_POST['name'] ) > 25 OR mb_strlen( trim( $_POST['name'] ) ) < 5 ) {
    $error = 1;
  }
  else {
    $params['name'] = preg_replace('/\s+/u', ' ', $_POST['name'] );
  }

  if ( !preg_match( '/^[а-яА-ЯЁёA-Za-z0-9\s.,]+$/iu', $_POST['bio'] ) OR mb_strlen( $_POST['bio'] ) > 2000 OR mb_strlen( trim( $_POST['bio'] ) ) < 5 ) {
    $error = 1;
  }
  else {
    $params['bio'] = preg_replace('/\s+/u', ' ', $_POST['bio'] );
  }

  if ( !isset( $_POST['photoban'] ) ) {

    $params['photo'] = uploadFile( 'photo' );

    if ( !$params['photo'] ) {
      $error = 1;
    }
    else {

      if ( isset( $params['id'] ) ) {

        $query = $database->prepare( 'SELECT photo FROM teachers WHERE id = ?' );
        $query->execute( [ intval( $params['id'] ) ] );

        if ( $row = $query->fetch() ) {
          removePhoto( $row['photo'] );
        }

      }

    }

  }

  if ( !isset( $error ) ) {

    if ( isset( $params['id'] ) ) {

      #Обновляем данные в базе данных
      if ( isset( $params['photo'] ) ) {
        $query = $database->prepare( 'UPDATE teachers SET name = :name, biography = :bio, experience = :date, photo = :photo WHERE id = :id' );
      }
      else {
        $query = $database->prepare( 'UPDATE teachers SET name = :name, biography = :bio, experience = :date WHERE id = :id' );
      }

    }
    else {
      $query = $database->prepare( 'INSERT INTO teachers (name, biography, experience, photo) VALUES (:name, :bio, :date, :photo)' );
    }

    $query->execute( $params );

    $page = returnInformationBox(
      'Готово',
      'Данные были успешно обработаны! Вы можете перейти на <a href="/manager">страницу</a> с объектами',
      'fas fa-check-circle'
    );

  }
  else {

    $page = returnInformationBox(
      'Ошибка',
      'Предоставленные данные заполнены в неправильной форме. Пожалуйста, <a href="/manager">вернитесь</a> и заполните их в соотвествии с примерами.',
      'fas fa-times-circle'
    );

  }

}
else {

  #Если не отправлена какая-либо форма и имеется подстраница - выводим страницу с редактированием преподавателя
  $tpl = new Template;

  if ( isset( $system['subdata'] ) ) {

    $query = $database->prepare( 'SELECT * FROM teachers WHERE id = ?' );
    $query->execute( [ intval( $system['subdata'] ) ] );

    if ( $row = $query->fetch() ) {

      $page = $tpl->load( 'manager.teacher.tpl' )
      ->set( '{name}', $row['name'] )
      ->set( '{experience-start}', $row['experience'] )
      ->set( '{experience}', yearSuffix( strtotime( $row['experience'] ) ) )
      ->set( '{foto}', '/template/images/database/' . $row['photo'] )
      ->set( '{foto-file}', $row['photo'] )
      ->set( '{id}', $row['id'] )
      ->set( '[edit]', '' )
      ->set( '[/edit]', '' )
      ->block( "'\\[add\\](.*?)\\[/add\\]'si", "" )
      ->set( '{biography}', $row['biography'] )
      ->compile();

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

    #Если подстраницы нет - выводит страницу с созданием преподавателя
    $page = $tpl->load( 'manager.teacher.tpl' )
    ->set( '{name}', '' )
    ->set( '{id}', '' )
    ->set( '{foto-file}', '' )
    ->set( '{experience-start}', '' )
    ->set( '{experience}', '' )
    ->set( '{biography}', '' )
    ->set( '{foto}', '' )
    ->set( '[add]', '' )
    ->set( '[/add]', '' )
    ->block( "'\\[edit\\](.*?)\\[/edit\\]'si", "" )
    ->compile();

  }

}

 ?>
