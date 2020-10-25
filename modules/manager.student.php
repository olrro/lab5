<?php

/*
=====================================================
 Менеджер студентов (Добавление и редактирование учеников)
 -------------------------------------
 Файл: manager.students.php
=====================================================
*/

#Если пользователь хочет удалить студента
if ( isset( $_POST['remove'] ) ) {

  if ( removeObject( $_POST['remove'], 'students') ) {

    $page = returnInformationBox(
      'Удалено',
      'Студент был успешно удален! Вы можете перейти на <a href="/manager">страницу</a> с объектами',
      'fas fa-check-circle'
    );

  }
  else {

    $page = returnInformationBox(
      'Ошибка',
      'Студента с таким ID не найдено. Пожалуйста, <a href="/manager">вернитесь</a> и обновите страницу',
      'fas fa-times-circle'
    );

  }

}
elseif ( isset( $_POST['name'] ) ) {

  #Если пользователь хочет добавить / редактировать студента
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

  if ( intval( $_POST['gender'] ) > 1 OR intval( $_POST['gender'] ) < 0 ) {
    $error = 1;
  }
  else {
    $params['gender'] = intval( $_POST['gender'] );
  }

  #Проверяем существует ли указанный преподаватель в базе
  $query = $database->prepare( 'SELECT id FROM teachers WHERE id = ?' );
  $query->execute( [ intval( $_POST['teacher_id'] ) ] );

  if ( !$row = $query->fetch() ) {
    $error = 1;
  }
  else {
    $params['teacher_id'] = intval( $_POST['teacher_id'] );
  }

  if ( !isset( $_POST['photoban'] ) ) {

    $params['photo'] = uploadFile( 'photo' );

    if ( !$params['photo'] ) {
      $error = 1;
    }
    else {

      if ( isset( $params['id'] ) ) {

        $query = $database->prepare( 'SELECT photo FROM students WHERE id = ?' );
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
        $query = $database->prepare( 'UPDATE students SET teacher_id = :teacher_id, name = :name, gender = :gender, birthday = :date, photo = :photo WHERE id = :id' );
      }
      else {
        $query = $database->prepare( 'UPDATE students SET teacher_id = :teacher_id, name = :name, gender = :gender, birthday = :date WHERE id = :id' );
      }

    }
    else {
      $query = $database->prepare( 'INSERT INTO students (teacher_id, name, gender, birthday, photo) VALUES (:teacher_id, :name, :gender, :date, :photo)' );
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


  #Если не отправлена какая-либо форма и имеется подстраница - выводим страницу с редактированием студента
  $tpl = new Template;

  if ( isset( $system['subdata'] ) ) {

    $query = $database->prepare( 'SELECT * FROM students WHERE id = ?' );
    $query->execute( [ intval( $system['subdata'] ) ] );

    if ( $row = $query->fetch() ) {

      $tpl->load( 'manager.student.tpl' )
      ->set( '{name}', $row['name'] )
      ->set( '{teacher_id}', $row['teacher_id'] )
      ->set( '{gender}', returnGender( $row['gender'] ) )
      ->set( '{birthday}', $row['birthday'] )
      ->set( '{foto-file}', $row['photo'] )
      ->set( '{foto}', '/template/images/database/' . $row['photo'] )
      ->set( '{id}', $row['id'] )
      ->set( '[edit]', '' )
      ->set( '[/edit]', '' )
      ->block( "'\\[add\\](.*?)\\[/add\\]'si", "" );

      if ( $row['gender'] ) {
        $tpl->set( '{gender-male}', 'checked' )->set( '{gender-female}', '' );
      }
      else {
        $tpl->set( '{gender-male}', '' )->set( '{gender-female}', 'checked' );
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
  else {

    #Если подстраницы нет - выводит страницу с созданием студента
    $page = $tpl->load( 'manager.student.tpl' )
    ->set( '{name}', '' )
    ->set( '{teacher_id}', '' )
    ->set( '{gender}', '' )
    ->set( '{id}', '' )
    ->set( '{foto-file}', '' )
    ->set( '{foto}', '' )
    ->set( '{birthday}', '' )
    ->set( '[add]', '' )
    ->set( '[/add]', '' )
    ->block( "'\\[edit\\](.*?)\\[/edit\\]'si", "" )
    ->compile();

  }

}

 ?>
