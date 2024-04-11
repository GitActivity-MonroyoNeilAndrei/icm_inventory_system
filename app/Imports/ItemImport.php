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
        $date_today = now()->format('Y-m-d');
    
        $firstRowSkipped = false;
    
        foreach ($rows as $row) {
            // Skip the first row
            if (!$firstRowSkipped) {
                $firstRowSkipped = true;
                continue;
            }
    
            Item::create([
                'name' => $row[0],
                'category' => $row[1],
                'serial_no' => $row[2],
                'model' => $row[3],
                'description' => $row[4],
                'additional_details' => $row[5],
                'status' => $row[6],
                'condition' => $row[7],
                'date_acquisition' => $row[8],
                'date_added' => $date_today,
                'added_by' => auth()->user()->id,
            ]);
        }
    }
    
    
}
