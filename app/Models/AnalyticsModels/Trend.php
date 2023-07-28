<?php
namespace App\Models\AnalyticsModels;

use JsonSerializable;

class Trend implements JsonSerializable {
    public string $label; //" => "",
    public array $data = []; //" => [640, 3765, 530, 302, 430, 270, 488],

    public function backgroundColor() {
        switch($this->label) {
            case 'Sales':
                return '#63ed7a';
            case 'Sales Returns':
                return '#fc544b';
            case 'Purchases':
                return '#6777ef';
            case 'Purchase Returns':
                return '#ffa426';
            default:
            return '#333333';
        }
    }

    public function jsonSerialize() {
        return [
            "label" => $this->label,
            "data" => $this->data,
            "color" => $this->backgroundColor()
        ];
    }
}