<?php

/*
=====================================================
 Некоторые функции для важной работы
 -------------------------------------
 Файл: functions.php
=====================================================
*/

#Возвращает суффикс для года (например 2 года или 7 лет)
function yearSuffix( $year ) {

    $year = floor( ( time() - intval( $year ) ) / 31536000 );
    $year = abs( $year );

    $t1 = $year % 10;
    $t2 = $year % 100;

    if ( $t1 == 1 AND $t2 != 11 ) return "{$year} год";
    elseif ( $t1 >= 2 AND $t1 <= 4 AND ($t2 < 10 || $t2 >= 20 ) ) return "{$year} года";
    else return "{$year} лет";

}

#Возвращает название пола для человека ( 1 = мужской , 0 = женский)
function returnGender( $gender )
{

  if ( intval( $gender ) ) return 'мужской';
  else return 'женский';

}

# Возвращает панель пользователя сверху
function returnPopUpProfile()
{

  global $system;

  if (isset( $_SESSION['logged_user'] ) ) {

    $tpl = new Template;
    return $tpl->load( 'user.tpl' )->set( '{username}', $system['user_data']['login'] )->compile();

  }
  else return '<a class="btn btn-primary" href="/login">Войти</a>';

}

function removePhoto( $avatar )
{

  $file = ROOT_DIR . '/template/images/database/' . $avatar;
  if ( file_exists( $file ) ) return unlink( $file );
  else return 1;

}

#Удаляет объект из базы данных (студент или преподаватель) и сообщает о статусе операции
function removeObject( $id, $type )
{

  global $database;

  if ( in_array( $type, ['teachers', 'students'] ) ) {

    if ( $type == 'teachers' ) {

      $query = $database->prepare( 'SELECT photo FROM students WHERE teacher_id = ?' );
      $query->execute( [ intval( $id ) ] );

      while ( $row = $query->fetch() ) removePhoto( $row['photo'] );

    }

    $part = 'FROM ' . $type . ' WHERE id = ?';

    $query = $database->prepare( 'SELECT photo ' . $part );
    $query->execute( [ intval( $id ) ] );

    if ( $row = $query->fetch() ) {

      $query = $database->prepare( 'DELETE ' . $part );
      $query->execute( [ intval( $id ) ] );

      return removePhoto( $row['photo'] );

    } else return 0;

  }
  else return 0;

}

#Загружает файл в папку и сообщает о статусе операции
function uploadFile( $name )
{

  if ( isset( $_FILES[$name] ) ) {

    if ( $_FILES[$name]['type'] == 'image/png' ) $img_type = 'png';
    elseif( $_FILES[$name]['type'] == 'image/jpeg') $img_type = 'jpg';
    else return 0;

    if ( $_FILES[$name]['size'] > 1048576 ) return 0;
    if ( $_FILES[$name]['error'] != UPLOAD_ERR_OK ) return 0;

    do {

      $file = md5( basename( $_FILES[$name]["name"] ) . time() ) . '.' . $img_type;
      $dir = ROOT_DIR . '/template/images/database/' . $file;

    } while ( file_exists( $dir ) );

    if ( move_uploaded_file( $_FILES[$name]["tmp_name"], $dir ) ) return $file;
    else return 0;

  }
  else return 0;


}

# Выводит окно с информацией на сайте
function returnInformationBox( $title, $info, $icon = '' )
{

  $tpl = new Template;

  $tpl->load( 'info.tpl' )->set( '{title}', $title );

  if ( $icon ) $tpl->set( '{icon}', "<i class=\"{$icon} text-primary\"></i>" );
  else $tpl->set( '{icon}', '' );

  return $tpl->set( '{info}', $info )->compile();

}


 ?>
