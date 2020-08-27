<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Check;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class CheckExport implements FromCollection, ShouldAutoSize, WithEvents, WithHeadingRow, WithHeadings, WithMapping
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        foreach($this->data as $item){
            if($item->photo !=  null)
                $item->photo = asset("/i/" . $item->photo ) ;
        }
        return $this->data;
    }

    public function map($check): array
    {
        return [
            $check->id,
            $check->created_at,
            $check->photo,
            $check->status,
            $check->user->id,
            $check->user->name,
            $check->user->email,
            $check->type

        ];
    }

    public function headings(): array
    {
        return ['ID', 'Дата', 'Чек', 'Статус', 'ID Пользователя', 'Имя', 'Телефон', 'Магазин'];
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
