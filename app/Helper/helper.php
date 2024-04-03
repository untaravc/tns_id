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

if (!function_exists('str_to_link')) {
  function str_to_link($text)
  {
    $text = str_replace(' ', '-', $text);
    $text = strtolower($text);
    $text = preg_replace('/[^a-zA-Z0-9_ %\\[\\]\\.\\(\\)%&-]/s', '', $text);
    return $text;
  }
}
