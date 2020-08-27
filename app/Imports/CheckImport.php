<?php

namespace App\Imports;

use App\Check;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class CheckImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row[0])){
            $data = new Check([
                'photo' => $row[0],
                'status' => $row[1],
                'user_id' => $row[2],
            ]);
        }
        return $data;
    }
}
