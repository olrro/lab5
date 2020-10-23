<?php

/*
=====================================================
 Поиск по файлам [AJAX]
 -------------------------------------
 Файл: search.php
=====================================================
*/

define( 'ROOT_DIR', substr( dirname(  __FILE__ ), 0, -5 ) );

# Подключаем все требуемые файлы
require ROOT_DIR . '/classes/template.class.php';
require ROOT_DIR . '/modules/search.php';

# Добавим задержку для имитации поиска
sleep(1);

if ( $search_results ) {
  echo $search_results;
}
else {
  header( 'HTTP/1.1 403 Forbidden' );
  header( 'Location: /' );
}


 ?>
