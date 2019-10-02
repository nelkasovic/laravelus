<?php

namespace App\Exports;

use App\Person;
use Lang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PersonsExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Auth()->user()->client->persons;
    }

    
    
    public function headings(): array
    {
        return [
            Lang::get('common.Number'),
            Lang::get('common.Client'),
            Lang::get('common.Period'),
            Lang::get('common.Import'),
            Lang::get('common.Salutation'),
            Lang::get('common.FirstName'),
            Lang::get('common.LastName'),
            Lang::get('common.Title'),
            Lang::get('common.Company'),
            Lang::get('common.Email'),
            Lang::get('common.Phone'),
            Lang::get('common.Mobile'),
            Lang::get('common.Fax'),
            Lang::get('common.Website'),
            Lang::get('common.Picture'),
            Lang::get('common.Active'),
            Lang::get('common.Approved'),
            Lang::get('common.Changed'),
            Lang::get('common.Notes'),
            Lang::get('common.DateCreated'),
            Lang::get('common.DateUpdated'),
        ];
    }

    /**
    * @return array
    */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                
                /*
                $cellRange = 'A1:W1000'; 
                $header = 'A1:W1';

                $event->sheet->getDelegate()->getDefaultRowDimension()->setRowHeight(20);
                $event->sheet->getDelegate()->getStyle($header)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('F7F7F7');
                $event->sheet->getDelegate()->getStyle($header)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');
                */
            },
        ];
    }
}
