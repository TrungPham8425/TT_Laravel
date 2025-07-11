<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

class ReportSummaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily summary report';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Logic gửi email thống kê
        $this->info('Daily summary report sent successfully!');
    }
}

class BackupDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database weekly';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Logic backup database
        $this->info('Database backup completed successfully!');
    }
}
