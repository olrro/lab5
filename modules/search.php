<?php

/*
=====================================================
 Поиск по файлам, обработчик
 -------------------------------------
 Файл: search.php
=====================================================
*/

# Устанавливаем стандартную кодировку

mb_internal_encoding( 'UTF-8' );

$tpl = new Template;

$search_results = [];

if ( isset( $_POST['request'] ) ) {

  # Очищаем запрос от ненужных символов

  $request = strip_tags( $_POST['request'] );
  $request = preg_replace('/\s+/', ' ', $request );

  if ( mb_strlen( $request ) < 150 AND mb_strlen( trim( $request ) ) > 5 ) {

    # Сканируем папку и помещаем файлы в массив

    $files_path = ROOT_DIR . '/html';
    $files = array_diff( scandir( $files_path ), [ '.', '..' ] );

    $counter = 0;

    foreach ( $files as $path ) {

      $data = file_get_contents( $files_path . '/' . $path );

      # Конвертируем файл в кодировку UTF-8

      $data = iconv( mb_detect_encoding( $data ), "UTF-8", $data );
      $data = preg_replace('/\s+/', ' ', strip_tags( $data ) );

      $request = mb_strtolower( $request );

      $position = mb_stripos( $data, $request, 0 );

      # Проверяем есть ли требуемый текст в строке

      if ( $position !== false ) {

        # Режем строку, чтобы увидеть больше по бокам

        if ( ( $position - 20 ) >= 0 ) {
          if ( $position + ( mb_strlen( $request ) + 100 ) <  mb_strlen( $data ) ) {
            $data = mb_substr( $data, $position - 20, mb_strlen( $request ) + 100 );
          }
          else {
            $data = mb_substr( $data, $position - 20, mb_strlen( $data ) );
          }
        }
        else {
          if ( $position + 100 <  mb_strlen( $data) ) {
            $data = mb_substr( $data, 0, 100 );
          }
          else {
            $data = mb_substr( $data, 0, mb_strlen( $data ) );
          }
        }

        # Подсвечиваем результаты
        $data = preg_replace( '/'.preg_quote( $request , '/' ).'/ui', "<u class=\"text-primary h4\">{$request}</u>" , $data );

        # Заполняем массив с результатами поиска

        $search_results[] = $tpl->load( 'search.result.tpl' )
        ->block( "'\\[not-found\\](.*?)\\[/not-found\\]'si", "" )
        ->set( '[found]', '' )
        ->set( '[/found]', '' )
        ->set( '{number}', $counter + 1 )
        ->set( '{title}', 'Файл - ' . $path )
        ->set( '{link}', '/html/' . $path )
        ->set( '{description}', $data )
        ->compile();

        $counter++;

      }

      if ( $counter >= 5 ) {
        break;
      }

    }

  }

  if ( $search_results ) {

    $search_results = implode( "", $search_results );

  }
  else {

    $search_results = $tpl->load( 'search.result.tpl' )
    ->block( "'\\[found\\](.*?)\\[/found\\]'si", "" )
    ->set( '{error}', 'Ничего не найдено' )
    ->set( '[not-found]', '' )
    ->set( '[/not-found]', '' )
    ->compile();

  }

}


 ?>
