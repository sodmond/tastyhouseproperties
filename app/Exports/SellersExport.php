<?php

namespace App\Exports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellersExport implements FromCollection, WithHeadings
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
        return Seller::join('cities', 'sellers.city', '=', 'cities.id')->join('states', 'sellers.state', '=', 'states.id')
                    ->whereRaw("MONTH(sellers.created_at) = $this->month AND YEAR(sellers.created_at) = $this->year")
                    ->select('sellers.firstname', 'sellers.lastname', 'sellers.companyname', 'sellers.email', 'sellers.phone', 
                    'sellers.dob', 'sellers.gender', 'sellers.address', 'cities.name as city', 'states.name as state', 'sellers.zip', 'sellers.created_at')
                    ->get();
    }

    public function headings() : array
    {
        return [
            'FIRSTNAME',
            'LASTNAME',
            'COMPANYNAME',
            'EMAIL',
            'PHONE',
            'DATE OF BIRTH',
            'GENDER',
            'ADDRESS',
            'CITY',
            'STATE',
            'ZIP CODE',
            'DATE CREATED'
        ];
    }
}
