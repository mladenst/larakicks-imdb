<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use File;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    protected $description = 'Backup the database';

    protected $process;

    public function __construct()
    {
        parent::__construct();

        $path = storage_path('backups');
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        delete_old_backups();

        $savePath = storage_path('backups/backup-'. str_replace(' ', "--", Carbon::now()->toDateTimeString()).'.sql.gz');
        $this->process = new Process(sprintf(
            'mysqldump --user=%s --password=%s --single-transaction --quick --lock-tables=false %s | gzip -9> %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            $savePath
        ));
    }

    public function handle()
    {
        try {
            $this->process->mustRun();

            $this->info('The backup has been proceed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error($exception);
            $this->error('The backup process has been failed.');
        }
    }
}
