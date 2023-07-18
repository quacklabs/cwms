<?php

namespace App\Services;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use App\Models\Sale;
use App\Models\SaleReturn;

class ExportService {

    public static function export_transactions(int $start, int $end, string $format, string $flag) {
        $data = ($flag == 'sale') ? Sale::whereBetween('id', [$start, $end])->get() : Purchase::whereBetween('id', [$start, $end])->get();
        switch($format) {
            case 'pdf':
                return self::sendPDF($data, 'export.transactions');
                break;
            case 'xls':
                break;
        }
    }

    public static function export_returns(int $start, int $end, string $format, string $flag) {
        $data = ($flag == 'sale') ? SaleReturn::whereBetween('id', [$start, $end])->get() : PurchaseReturn::whereBetween('id', [$start, $end])->get();
        switch($format) {
            case 'pdf':
                return self::sendPDF($data, 'export.transactions');
                break;
            case 'xls':
                break;
        }
    }

    public static function sendXLS($html, $name) {

    }


    public static function sendPDF($data, $template) {
        $cssFile = file_get_contents(public_path('css/style.css'));
        $bootstrapFile = file_get_contents(public_path('css/bootstrap.css'));
        $componentsFile = file_get_contents(public_path('css/components.css'));
        $logo = base64_encode(file_get_contents(public_path('img/logo.png')));
        $title = ucwords($flag)." Return Details";
        $page = [
            'bootstrap' => $bootstrapFile,
            'style' => $cssFile,
            'components' => $componentsFile,
            'title' => $title,
            'flag' => ucwords($flag),
            'items' => $data,
            'logo' => $logo
        ];
        $html = View::make($template, $page);
        
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $options = new Options();
        $options->set('defaultFont', 'Arial Unicode MS');
        $options->set('dpi', 150);
        $pdf->setOptions($options);
        $pdf->render();
        $pdfContent = $pdf->stream();
        return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="'.$name.'"');
    }
    
}