<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
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
        return Product::join('sellers', 'products.seller_id', '=', 'sellers.id')->join('cities', 'products.city_id', '=', 'cities.id')
            ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->whereRaw("MONTH(products.created_at) = $this->month AND YEAR(products.created_at) = $this->year")
            ->select('sellers.companyname', 'product_categories.title as category', 'products.title', 'products.condition', 'products.price_type', 'products.price', 'cities.name', 'products.created_at', 'products.views')
            ->get();
    }

    public function headings() : array
    {
        return [
            'VENDOR',
            'CATEGORY',
            'TITLE',
            'CONDITION',
            'PRICE TYPE',
            'PRICE',
            'CITY',
            'DATE CREATED',
            'VIEWS'
        ];
    }
}
