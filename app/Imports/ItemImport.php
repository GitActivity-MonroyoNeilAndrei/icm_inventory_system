<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Carbon;

class ItemImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    

    public function collection(Collection $rows)
    {

        $date = Carbon::now();

        $date_today = $date->format('Y-m-d');

        foreach ($rows as $row) {
            Item::create([
                'name' => $row[0],
                'category' => $row[1],
                'serial_no' => $row[2],
                'model' => $row[3],
                'description' => $row[4],
                'additional_details' => $row[5],
                'status' => $row[6],
                'date_acquisition' => $row[7],
                'date_added' => $date_today,
                'added_by' => auth()->user()->id,
            ]);
        }
    }
    
    
}
