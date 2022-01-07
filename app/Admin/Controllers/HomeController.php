<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pond;
use App\Models\User;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin as FacadesAdmin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        FacadesAdmin::js('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js');

        $user_has_harvest = User::has('ponds')->whereHas('ponds', function ($query)
        {
            $query->where('status', Pond::STATUS2);
        })->pluck('name');
        $user_has_pond = User::has('ponds')->whereHas('ponds', function ($query)
        {
            $query->where('status', Pond::STATUS2);
        })->pluck('name', 'id');
        $count_harvest = [];
        foreach ($user_has_pond as $key => $value) {
            $count_harvest[] += Pond::where('user_id', $key)->where('status', Pond::STATUS2)->get()->count();
        }
        $collect = collect($count_harvest);
        return $content
            ->title('Dashboard')
            // ->description('Description...')
            ->row('<center><h1>Avesma</h1></center>')
            ->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $infoBox = new InfoBox('New Users', 'users', 'aqua', '/admin/users', count(User::get()));

                    $column->append($infoBox->render());
                });
                $row->column(6, function (Column $column) {
                    $infoBox = new InfoBox('Total Harvest', 'leaf', 'green', '/admin/ponds', count(Pond::where('status', Pond::STATUS2)->get()));

                    $column->append($infoBox->render());
                });
            })
            ->body(view('admin.charts.bar', compact('user_has_harvest', 'collect')));
    }
}
