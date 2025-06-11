<?php

namespace App\Exports;

use App\Models\Newsletter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NewsletterExport implements FromCollection, WithHeadings
{
    public $month;
    public $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Newsletter::whereRaw("MONTH(created_at) = $this->month AND YEAR(created_at) = $this->year")
                ->select('email', 'created_at')
                ->get();
    }

    public function headings() : array
    {
        return [
            'EMAIL',
            'DATE CREATED',
        ];
    }
}
