<?php

/*
=====================================================
 Менеджер объектов в базе данных
 -------------------------------------
 Файл: manager.php
=====================================================
*/

#Изменение режима работы редактора объектов (1 = преподаватель, 0 = студент)
if ( isset( $_POST['editor_type'] ) ) {

  if ( intval( $_POST['editor_type'] ) ) {
    $editor_mode = 1;
  }
  else {
    $editor_mode = 0;
  }

  #Режим работы храниться в куках пользователя
  setcookie( 'editor_mode', $editor_mode, time() + ( 60 * 60 * 24 ) );
  header( 'Location: /manager/editor' );

  exit();

}
else {

  #Если куки нет - будет создана новая
  if ( isset( $_COOKIE['editor_mode'] ) ) {
    $editor_mode = intval( $_COOKIE['editor_mode'] );
  }
  else {
    setcookie( 'editor_mode', '1', time() + ( 60 * 60 * 24 ) );
    $editor_mode = 1;
  }

}

#Если пользователь авторизован - выводим панель управления
if ( isset( $_SESSION['logged_user'] ) ) {

  if ( isset( $system['subpage'] ) ) {

    switch ( $system['subpage'] ) {

      case 'editor':

        $query = 'SELECT * FROM ' . ( $editor_mode ? 'teachers' : 'students' );

        $results = [];

        $tpl = new Template;

        foreach ( $database->query( $query ) as $row ) {

          #Строим элементы редактора (список с преподавателями или студентами)
           $tpl->load( 'manager.editor.item.tpl' )
           ->set( '{name}', $row['name'] )
           ->set( '{id}', $row['id'] )
           ->set( '{foto}', '/template/images/database/' . $row['photo'] );

           if ( $editor_mode ) {

             $tpl->block( "'\\[student\\](.*?)\\[/student\\]'si", "" )
             ->set( '[teacher]', '' )
             ->set( '[/teacher]', '' )
             ->set( '{biography}', mb_strimwidth( $row['biography'], 0, 80, "...") )
             ->set( '{experience}', yearSuffix( strtotime( $row['experience'] ) ) );

           }
           else {

             $tpl->block( "'\\[teacher\\](.*?)\\[/teacher\\]'si", "" )
             ->set( '[student]', '' )
             ->set( '[/student]', '' )
             ->set( '{gender}', returnGender( $row['gender'] ) )
             ->set( '{birthday}', $row['birthday'] );

           }

           $results[] = $tpl->compile();

        }

        #Строим шаблон редактора
        $tpl->load( 'manager.editor.tpl' );

        if ( $results ) {
          $tpl->set( '{results}', implode( '', $results ) )
          ->block( "'\\[not-found\\](.*?)\\[/not-found\\]'si", '' );
        }
        else {
          $tpl->set( '{results}', '' )->set( '[not-found]', '' )
          ->set( '[/not-found]', '' );
        }

        $page = $tpl->compile();

      break;

      case 'teacher':

        #Если создается или редактируется преподаватель
        require_once ROOT_DIR . '/modules/manager.teacher.php';

      break;

      case 'student':

        #Если создается или редактируется студент
        require_once ROOT_DIR . '/modules/manager.student.php';

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

    #Если подстраница не указана - выводим страницу с управлением (/manager)
    $tpl = new Template;
    $page = $tpl->load( 'manager.tpl' )->compile();

  }

}
else {

  $page = returnInformationBox(
    'Вы не авторизованы',
    'Чтобы использовать эту страницу необходимо авторизоваться. Перейти на <a href="/login">страницу</a> авторизации',
    'fas fa-lock'
  );

}





 ?>
