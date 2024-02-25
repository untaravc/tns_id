<?php

namespace App\Services;

use GuzzleHttp\Client;

class FirebaseStorageService
{
  public function upload($file_name, $file)
  {
    $bucket = env('FIREBASE_BUCKET');
    $folder = env('FIREBASE_FOLDER');
    $token = env('FIREBASE_UPLOAD_TOKEN');
    $file_name = str_replace(' ', '-', $file_name);

    $config['url'] = 'https://firebasestorage.googleapis.com/v0/b/' . $bucket . '/o?uploadType=media&name=' . $folder . '/' . $file_name . '&modul_token=' . $token;
    $client = new Client();

    $response = $client->post($config['url'], [
      'file' => $file,
    ], [
      ""
    ]);

    $result = json_decode($response->getBody());

    return $this->generateFileLink($result);
  }

  public function generateFileLink($result)
  {
    $token = env('FIREBASE_UPLOAD_TOKEN');
    $link = "https://firebasestorage.googleapis.com/v0/b/";
    $link .= $result->bucket . '/o?uploadType=media&name=';
    $link .= $result->name;
    $link .= '&modul_token=' . $token;

    return $link;
  }
}
