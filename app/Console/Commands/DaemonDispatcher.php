<?php

namespace App\Console\Commands;

use App\Model\Crawler\DaemonDispatcher as DD;
use Illuminate\Console\Command;

class DaemonDispatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DaemonDispatcher:Start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Daemon Dispatcher';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('==========Start Listen==========');
        $dd = DD::getInstance();
        $dd->listen();
    }
}
