<?php

namespace App\Admin\Actions\Pond;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Statistic extends RowAction
{
    protected $id;
    public $name = 'Statistic';

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function href()
    {
        return "/admin/ponds/statistic/".$this->id;
    }

}