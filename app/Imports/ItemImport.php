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
    
        $expectedColumnCount = 12; 

        $firstRowSkipped = false;
    
        foreach ($rows as $row) {
            // Skip the first row
            if (!$firstRowSkipped) {
                $firstRowSkipped = true;
                continue;
            }

            if (count($row) !== $expectedColumnCount) {
                // Return a prompt that the column count must be 9
                return redirect()->route('admin.item.index')->with('errorColumnCount', 'CSV Columns must be exactly 9');
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
