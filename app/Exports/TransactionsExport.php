<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Query\Builder;

class TransactionsExport implements FromCollection, WithHeadings
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query->get();
    }

    public function headings(): array
    {
        return [
            'Transaction Date',
            'Item',
            'Issued To',
            'Issued By',
            'Status',
            'Condition',
            'Category',
            'Serial No.',
            'Model',
            'Description',
            'Additional Details',
            'Location',
            'Date Acquisition',
            'Date Added'
        ];
    }
}
