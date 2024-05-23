<?php
namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Picqer\Barcode\BarcodeGeneratorPNG;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\File;

class ItemsExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithEvents
{
    private $items;
    private $barcodes = [];

    public function collection()
    {
        $this->items = Item::all();

        // Generate barcodes
        $generator = new BarcodeGeneratorPNG();
        foreach ($this->items as $item) {
            $barcodeData = $generator->getBarcode($item->id, $generator::TYPE_CODE_128);
            $barcodeFilePath = sys_get_temp_dir() . '/barcode_' . $item->id . '.png';
            File::put($barcodeFilePath, $barcodeData);
            $this->barcodes[$item->id] = $barcodeFilePath;
        }

        return $this->items;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Category',
            'Serial No',
            'Model',
            'Description',
            'Additional Details',
            'Status',
            'Added By',
            'Condition',
            'Location',
            'Date Acquisition',
            'Date Added',
            'Barcode',
        ];
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->name,
            $item->category,
            $item->serial_no,
            $item->model,
            $item->description,
            $item->additional_details,
            $item->status,
            $item->added_by,
            $item->condition,
            $item->location,
            $item->date_acquisition,
            $item->date_added,
            '', // This will be replaced by the drawing
        ];
    }

    public function drawings()
    {
        $drawings = [];

        foreach ($this->items as $index => $item) {
            $drawing = new Drawing();
            $drawing->setName('Barcode');
            $drawing->setDescription('Barcode');
            $drawing->setPath($this->barcodes[$item->id]);
            $drawing->setHeight(50);
            $drawing->setCoordinates('N' . ($index + 3)); // Adjust if you have headings
            $drawings[] = $drawing;
        }

        return $drawings;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();
                // Set the width for the barcode column
                $sheet->getColumnDimension('N')->setWidth(20);
            },
        ];
    }
}
