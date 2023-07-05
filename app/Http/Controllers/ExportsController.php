<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExportService;


class ExportsController extends Controller
{
    public function export_transactions(Request $request) {
        $flag = $request->route('flag');
        $start = $request->route('start');
        $end = $request->route('end');
        $format = $request->route('format');

        if(!$flag || !$start || !$end || !$format) {
            return redirect()->route('dashboard');
        }

        $data = [
            'title' => 'Details'
        ];

        

        switch($flag) {
            case 'purchase':
                return ExportService::generate_purchase_details($start, $end, $format, $flag);
            case 'sale':
                return ExportService::generate_sale_details($start, $end, $format, $flag);
            default:
            break;
        }
        // return parent::render($data, $file);
    }
}
