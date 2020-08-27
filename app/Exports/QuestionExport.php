<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Question;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class QuestionExport implements FromCollection, ShouldAutoSize, WithEvents, WithHeadingRow, WithHeadings
{
    public $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->filter == 'all'){
            $data = Question::all();
        }
        else{
            $date_from = Carbon::parse(explode('-', $this->filter)[0])->format('Y-m-d');
            $date_to = Carbon::parse(explode('-', $this->filter)[1])->format('Y-m-d');
            $data = Question::whereBetween('created_at', [$date_from.' 00:00:00', $date_to.' 23:59:59'])->get();
        }
        foreach ($data as $item){
            // Добавляем что хотим
        }
        return $data;
    }
    public function headings(): array
    {
        return ['ID', 'created_at', 'updated_at', 'name', 'email', 'phone', 'question', 'answer', 'answered'];
    }

        /**
         * @return array
         */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:Z1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11)->setBold(true);
            },
        ];
    }
}
