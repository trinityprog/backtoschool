<?php

namespace App\Imports;

use App\FailedRequest;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class FailedRequestImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row[0])){
            $data = new FailedRequest([
                'request' => $row[0],
                'response' => $row[1],
                'user_id' => $row[2],
            ]);
        }
        return $data;
    }
}
