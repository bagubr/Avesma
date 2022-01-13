<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Pond\Statistic;
use App\Http\Controllers\Api\FormProcedureController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Resources\FormProcedureStatisticResource;
use App\Models\FishSpecies;
use App\Models\FormProcedure;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\Pond;
use App\Models\PondDetail;
use App\Models\User;
use Doctrine\DBAL\Schema\Index;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Layout\Column;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PondController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Data Kolam';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Pond());
        $grid->disableFilter();
        $grid->quickSearch('name');
        $grid->column('name', __('Nama Kolam'));
        $grid->column('user.name', __('User'));
        $grid->column('pond_detail.pond_spesies', __('Jenis Ikan'));
        $grid->column('pond_detail.seed_count', __('Jumlah Pakan'));
        $grid->column('area', __('Luas Area'))->display(function ($area)
        {
            return $area. ' m<sup>2</sup>';
        });
        $grid->column('latitude', __('Latitude'));
        $grid->column('longitude', __('Longitude'));
        $grid->column('address', __('Address'));
        $grid->column('status', __('Status'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('total_pengeluaran', __('Pengeluaran'))->default('Pengeluaran')->expand(function ($model) {
            $outcomes = Outcome::with('outcome_detail')->where('pond_detail_id', $model->pond_detail->id)->orderBy('id', 'desc')->get()->map(function ($outcome) {
                $data = $outcome->outcome_detail->map(function ($outcome_detail)
                {
                    return $outcome_detail->only(['outcome_name', 'price']);
                });
                $outcome->outcome_detail = $this->convertStringOutcome(json_decode($data, 1));
                return $outcome->only(['id', 'outcome_category_name', 'total_nominal', 'outcome_detail', 'reported_at']);
            });
            // dd($outcome->outcome_detail);
            return new Table(['ID', 'Pengeluaran', 'Total Nominal', 'Detail Laporan', 'Laporan Pada'], $outcomes->toArray());
        });
        $grid->column('total_pemasukan', __('Pemasukan'))->default('Pemasukan')->expand(function ($model) {
            $incomes = Income::with('income_detail')->where('pond_detail_id', $model->pond_detail->id)->orderBy('id', 'desc')->get()->map(function ($income) {
                $data = $income->income_detail->map(function ($income_detail)
                {
                    return $income_detail->only(['product_name', 'price', 'weight', 'total_price']);
                });
                $income->income_detail = $this->convertStringIncome(json_decode($data, 1));

                return $income->only(['id', 'total_price', 'income_detail', 'reported_at']);
            });
            return new Table(['ID', 'Total Nominal', 'Detail Laporan', 'Laporan Pada'], $incomes->toArray());
        });
        $grid->actions(function ($actions){
            $actions->add(new Statistic($actions->getKey()));
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Pond::findOrFail($id));

        $show->field('user.name', __('User'));
        $show->field('pond_detail.pond_spesies', __('Jenis Ikan'));
        $show->field('pond_detail.seed_count', __('Jumlah Pakan'));
        $show->field('name', __('Nama Kolam'));
        $show->field('area', __('Luas Area'));
        $show->field('latitude', __('Latitude'));
        $show->field('longitude', __('Longitude'));
        $show->field('address', __('Address'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->pond_harvest('Hasil Panen', function ($pond_harvests) {

            $pond_harvests->setResource('/admin/pond-harvests');

            $pond_harvests->weight();
            $pond_harvests->image()->image();
            $pond_harvests->harvest_at();
            $pond_harvests->description();
            $pond_harvests->status();
            $pond_harvests->disableCreateButton();
            $pond_harvests->disableFilter();
            $pond_harvests->disableExport();
            $pond_harvests->disableColumnSelector();
            $pond_harvests->disablePagination();
            $pond_harvests->disableRowSelector();
            $pond_harvests->disableActions();
            // $pond_harvests->actions(function (Grid\Displayers\Actions $actions) {
            //     $actions->disableDelete();
            // });
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Pond());

        $form->select('user_id', __('User'))->options(User::get()->pluck('name', 'id'))->rules('required');
        $form->text('name', __('Nama Kolam'))->rules('required');
        $form->select('pond_detail.fish_species_id', 'Jenis Ikan')->options(FishSpecies::get()->pluck('name', 'id'))->rules('required');
        $form->decimal('area', __('Lusa Area'))->rules('required');
        $form->latlong('latitude', 'longitude', 'Latitude - Longitude')->default(['lat' => -6.974309, 'lng' => 110.426674])->zoom(11)->rules('required');
        $form->text('address', __('Address'))->rules('required');
        $form->text('description', __('Description'))->rules('required');
        $form->number('pond_detail.seed_count', __('Jumlah Pakan'))->rules('required');

        // $form->saved(function (Form $form) use ()
        // {
        //     $pond_detail = new PondDetail();
        //     $fish_species_id = $form->model()->fish_species_id;
        //     $pond_detail->fish_species_id = $fish_species_id;
        //     $seed_count = $form->model()->seed_count;
        //     $pond_detail->seed_count = $seed_count;
        //     $pond_detail->pond_id = $form->model()->id;
        //     $pond_detail->save();
        // });
        // $form->saving(function (Form $form)
        // {
        //     $form->ignore('fish_species_id', 'seed_count');
        // });
        
        return $form;
    }

    public function statistic(Content $content, $id)
    {
        $form_procedures = FormProcedure::with(['form_procedure_input_users' => function ($q) use ($id){
            $q->where('pond_detail_id', $id)->orderBy('reported_at', 'desc');
        }])->get();
        $form_procedures = FormProcedureStatisticResource::collection($form_procedures);
        return $content
        ->title('Statistic')
        ->row('<center><h1>Avesma</h1></center>')
        ->row(function (Row $row) use ($form_procedures){
            foreach ($form_procedures as $key => $value) {
                    $data = $value->form_procedure_input_users->map(function ($item)
                    {
                        return $item->total_score;
                    });

                    $label = $value->form_procedure_input_users->map(function ($item)
                    {
                        return date("d-M-Y", strtotime($item->created_at)).' '.$item->form_procedure_formula;
                    });
                    $chartjs = $value->procedure_name;
                    $row->column(4, function (Column $column) use ($chartjs, $data, $label) {
                        $label = collect($label);
                        $collect = collect($data);
                        $column->row(view('admin.charts.procedure', compact('label', 'collect', 'chartjs')));
                    });
                }
            });
    }
    
}
