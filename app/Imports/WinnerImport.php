<?php

namespace App\Imports;

use App\Winner;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class WinnerImport implements ToModel
{

    public function model(array $row)
    {
        if(!empty($row[0])){
            $data = new Winner([
                'name' => $row[0],
                'phone' => $row[1],
                'city' => $row[2],
                'prize' => $row[3],
                'type' => $row[4]
            ]);
        }
        return $data;
    }
}
