<?php

namespace App\Services;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;
use App\Models\Purchase;

class ExportService {

    public static function generate_purchase_details(int $start, int $end, string $format, string $flag) {
        
        // dd($start);
        $data = Purchase::whereBetween('id', [$start, $end])->get();
        
        $cssFile = file_get_contents(public_path('css/style.css'));
        $bootstrapFile = file_get_contents(public_path('css/bootstrap.css'));
        $componentsFile = file_get_contents(public_path('css/components.css'));
        $logo = base64_encode(file_get_contents(public_path('img/logo.png')));
        $title = ucwords($flag)." Details";
        $page = [
            'bootstrap' => $bootstrapFile,
            'style' => $cssFile,
            'components' => $componentsFile,
            'title' => $title,
            'flag' => ucwords($flag),
            'items' => $data,
            'logo' => $logo
        ];

        // dd($data);
        // $style = $css
        switch($format) {
            case 'pdf':
                $html = View::make('export.transactions', $page);
                $name = "history_". $data->first()->created_at ."_".$data->last()->created_at.".pdf";
                return self::sendPDF($html, $name);
                break;
            case 'xls':
                break;
        }


    }

    public static function sendPDF($html, $name) {
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $options = new Options();
        $options->set('defaultFont', 'Arial Unicode MS');
        $options->set('dpi', 150);
        $pdf->setOptions($options);
        $pdf->render();
        $pdfContent = $pdf->output();
        return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="'.$name.'"');
    }
    
}