<?php

namespace App\Console\Commands;

use App\Services\NotificationService;
use Illuminate\Console\Command;

class ProcedureReminderLongTerm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'procedure:longterm';

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
        NotificationService::sendToTopic('Remainder', 'Segera Update Siklus Budidaya Anda dan Evaluasi Hasil Budidaya Dengan Mudah Bersama AVESMA', 'remainder-long-term', null);
        return $this->warn('Succesfully send notification');
    }
}
