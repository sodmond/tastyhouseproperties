<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
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
        return User::whereRaw("MONTH(created_at) = $this->month AND YEAR(created_at) = $this->year")
            ->select('firstname', 'lastname', 'email', 'phone', 'created_at')
            ->get();
    }

    public function headings() : array
    {
        return [
            'FIRSTNAME',
            'LASTNAME',
            'EMAIL',
            'PHONE',
            'DATE CREATED'
        ];
    }
}
