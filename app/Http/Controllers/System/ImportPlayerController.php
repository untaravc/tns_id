<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\BaseController;
use App\Imports\PlayerImport;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportPlayerController extends BaseController
{
    const NAMA = 1;
    const DOB = 2;
    const POB = 3;
    const KATEGORI = 4;
    const JENIS_KELAMIN = 5;
    const KOTA = 6;
    const PROVINSI = 7;

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx',
        ]);

        if ($validator->fails()) {
            return $this->sendValidator($validator->errors());
        }

        $active_rows = $this->active_rows($request->file);

        $data_validator = $this->data_validator($active_rows);
        if (count($data_validator) > 0) return $data_validator;

        foreach ($active_rows as $cols) {
            $this->insertTable($cols);
        }

        return $this->sendResponse();
    }

    private function active_rows($file)
    {
        $tabs = Excel::toArray(new PlayerImport, $file);
        $rows = $tabs[0];

        $active_rows = [];
        foreach ($rows as $cols) {
            if ($cols[0] > 0) {
                $active_rows[] = $cols;
            }
        }
        return $active_rows;
    }

    private function data_validator($rows)
    {
        $errors = [];


        foreach ($rows as $col) {
            if (strlen($col[self::NAMA]) < 3) {
                $errors[] = 'Nama baris ke ' . $col[0] . ' harus diisi.';
            }

            if (strlen($col[self::PROVINSI]) < 3) {
                $errors[] = 'Provinsi baris ke ' . $col[0] . ' harus diisi.';
            }

            if (!in_array($col[self::KATEGORI], ['senior', 'junior'])) {
                $errors[] = 'Kategori baris ke ' . $col[0] . ' tidak sesuai. harus senior / junior ' . $col[self::KATEGORI];
            }

            if (!in_array($col[self::JENIS_KELAMIN], ['laki-laki', 'perempuan'])) {
                $errors[] = 'Jenis kelamin baris ke ' . $col[0] . ' tidak sesuai. harus laki-laki / perempuan ' . $col[self::JENIS_KELAMIN];
            }

            if (!is_numeric($col[self::DOB])) {
                $errors[] = 'Tanggal lahir baris ke ' . $col[0] . ' tidak sesuai.';
            } else {
                if ($col[self::DOB] < 35000 || $col[self::DOB] > 50000) {
                    $errors[] = 'Tanggal lahir baris ke ' . $col[0] . ' tidak sesuai.';
                }
            }
        }

        return $errors;
    }

    private function insertTable($cols)
    {
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($cols[self::DOB])->format('Y-m-d');
        $player_number = $this->create_number($cols[self::NAMA], $date);

        $player = Player::whereNumber($player_number)->first();

        $payload = [
            "name"         => $cols[self::NAMA],
            "display_name" => $cols[self::NAMA],
            "gender"       => $cols[self::JENIS_KELAMIN],
            "number"       => $player_number,
            "dob"          => $date,
            "pob"          => $cols[self::POB],
            "province"     => $cols[self::PROVINSI],
            "city"         => $cols[self::KOTA],
        ];

        if($player){
            $player->update($payload);
            return $this->sendResponse($player, 212);
        } else{
            $player = Player::create($payload);
        }

        return $this->sendResponse($player, 211);
    }

    private function create_number($name, $date)
    {
        $letter = substr($name, 0, 3);
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);

        return $year . strtoupper($letter) . $month . $day;
    }

    public function test(){
        return User::get();
    }
}
