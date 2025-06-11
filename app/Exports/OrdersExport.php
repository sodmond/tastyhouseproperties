<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
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
        return Order::join('products', 'orders.product_id', '=', 'products.id')->join('users', 'orders.user_id', '=', 'users.id')
                    ->where('code', 'LIKE', 'THS_%')
                    ->whereRaw("MONTH(orders.created_at) = $this->month AND YEAR(orders.created_at) = $this->year")
                    ->select('orders.code', 'users.firstname', 'users.lastname', 'orders.product_name', 'products.condition', 'orders.price_type', 'orders.amount', 'orders.created_at')
                    ->get();
    }

    public function headings() : array
    {
        return [
            'ORDER ID',
            'FIRSTNAME',
            'LASTNAME',
            'PRODUCT NAME',
            'CONDITION',
            'PRICE TYPE',
            'PRICE',
            'DATE CREATED'
        ];
    }
}
