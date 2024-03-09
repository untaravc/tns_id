<?

if (!function_exists('truncate')) {
  function truncate($text, $length = 14)
  {
    if (strlen($text) > $length) {
      $t = substr($text, 0, $length);
      return $t . '..';
    }
    return $text;
  }
}
