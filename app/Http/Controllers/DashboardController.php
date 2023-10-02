<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnalyticsService;
use App\Contracts\BusinessIntelligence;

class DashboardController extends Controller {
    //
    protected BusinessIntelligence $analytics;

    public function index(Request $request) {
        $analytics = new AnalyticsService();
        
        $data = [
            "title" => "Dashboard",
            "analytics" => $analytics
        ];
        return parent::render($data, 'dashboard');
    }
    // private function render(array $data, string $page) {
    //     // you can add other data to be used on admin before rendering
    //     return view($page, $data);
    // }
}
