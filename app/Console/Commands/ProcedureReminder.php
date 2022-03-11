<?php

namespace App\Console\Commands;

use App\Models\FormProcedureInputUser;
use App\Models\Procedure;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Console\Command;

class ProcedureReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'procedure:remainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $procedure = Procedure::inRandomOrder()->first();
        $user_id = FormProcedureInputUser::whereHas('form_procedure', function ($query) use ($procedure)
        {
            $query->where('procedure_id', $procedure->id);
        })->get()->pluck('user_id');
        $user = User::whereNotIn('user_id', $user_id)->whereNotNull('fcm_token')->get();
        NotificationService::sendSome('Remainder ' . $procedure->title, 'Segera Lengkapi Form '. $procedure->title.' Anda untuk Tetap Monitor dengan AVESMA', $user, $procedure);
        return $this->warn('Succesfully send notification');
    }
}
