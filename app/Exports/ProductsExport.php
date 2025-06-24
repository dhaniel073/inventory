<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all(['id', 'name', 'sku', 'quantity', 'cost_price', 'selling_price']);
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'SKU', 'Quantity', 'Cost Price', 'Selling Price'];
    }
}
