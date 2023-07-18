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
        return ExportService::export_transactions($start, $end, $format, $flag);
    }

    public function export_returns(Request $request) {
        $flag = $request->route('flag');
        $start = $request->route('start');
        $end = $request->route('end');
        $format = $request->route('format');

        if(!$flag || !$start || !$end || !$format) {
            return redirect()->route('dashboard');
        }
        return ExportService::export_returns($start, $end, $format, $flag);
    }
}
