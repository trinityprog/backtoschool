<?php

namespace App\Imports;

use App\Question;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row[0])){
            $data = new Question([
                'name' => $row[0],
                'email' => $row[1],
                'phone' => $row[2],
                'question' => $row[3],
                'answer' => $row[4],
                'answered' => $row[5],
            ]);
        }
        return $data;
    }
}
