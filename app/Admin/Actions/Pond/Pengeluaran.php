<?php

namespace App\Admin\Actions\Pond;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends RowAction
{
    protected $id;
    public $name = 'Pengeluaran';

    public function __construct($id)
    {
        $this->id = $id;
    }

    // public function handle(Model $model)
    // {
    //     // $model ...

    //     return $this->response()->success('Success message.')->refresh();
    // }

    public function href()
    {
        return "/admin/ponds/pengeluaran/".$this->id;
    }

}