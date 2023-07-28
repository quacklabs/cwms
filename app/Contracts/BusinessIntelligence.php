<?php
namespace App\Contracts;

use App\Models\AnalyticsModels\MonthStat;

interface BusinessIntelligence {
    public function purchase_statistics(): MonthStat;
    public function sales_statistics(): MonthStat;

    public function totalPurchase(): int;
    public function totalSale(): int;
}
