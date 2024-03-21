<?php

if (!function_exists('truncate_str')) {
  function truncate_str($text, $length = 14)
  {
    if (strlen($text) > $length) {
      $t = substr($text, 0, $length);
      return $t . '..';
    }
    return $text;
  }
}
