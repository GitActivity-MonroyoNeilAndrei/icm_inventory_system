<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;

class Barcode
{
  public static function generateBarcode($id)
  {

    // Create an instance of the BarcodeGeneratorHTML class
    $generator = new BarcodeGeneratorHTML();

    // Generate a barcode with a sample data ('0123456789') and the barcode type (e.g., TYPE_CODE_128)
    $barcode = $generator->getBarcode($id, $generator::TYPE_CODE_128);

    // Return the generated barcode
    return "<div style='padding: 1.5rem 5rem;'>$barcode</div>";


  }
}