<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;

class PondExporter extends ExcelExporter
{
    protected $fileName = 'List Kolam.xlsx';

    protected $columns = [
        'name' => 'Nama',
        "user.name" => 'Username',
        "pond_detail.pond_spesies" => 'Jenis Ikan',
        'pond_detail.seed_count' => 'Pakan',
        'area' => 'Luas Area/m2',
        'latitude' => 'Latitude',
        'longitude' => 'Longtitude',
        'address' => 'Alamat',
        'status' => 'Status',
    ];
}
