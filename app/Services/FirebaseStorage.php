<?php

namespace App\Services;

use GuzzleHttp\Client;

class FirebaseStorage
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
    ]);

    return $response->getBody();
  }
}
