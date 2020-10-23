<?php

/*
=====================================================
 Простой шаблонизатор для лабораторной
 -------------------------------------
 Файл: template.class.php
=====================================================
*/

class Template
{

  private
    $dir;
  private
    $tpl;
  private
    $params, $block;


  public function __construct()
  {

    $this->dir = ROOT_DIR . '/template/';

    $this->params = [];
    $this->block = [];

  }

  public function load( $tpl )
  {

    $this->tpl = file_get_contents( $this->dir . $tpl );

    return $this;

  }

  public function block( $text, $value )
  {

    $this->block[$text] = $value;

    return $this;

  }

  public function set( $text, $value )
  {

    $this->params[$text] = $value;

    return $this;

  }

  public function compile()
  {

    if ( count( $this->block ) ) {

      foreach ( $this->block as $key_find => $key_replace ) {
        $find_preg[] = $key_find;
        $replace_preg[] = $key_replace;
      }

      $this->tpl = preg_replace( $find_preg, $replace_preg, $this->tpl );

    }

    foreach ( $this->params as $key => $value ) {
      $this->tpl = str_replace( $key, $value, $this->tpl );
    }

    return $this->tpl;

  }


}




 ?>
