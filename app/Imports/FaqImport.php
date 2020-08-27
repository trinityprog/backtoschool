<?php

namespace App\Imports;

use App\Faq;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class FaqImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row[0])){
            $data = new Faq([
                'question_ru' => $row[0],
                'question_kk' => $row[1],
                'answer_ru' => $row[2],
                'answer_kk' => $row[3],
            ]);
        }
        return $data;
    }
}
