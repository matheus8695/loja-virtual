<?php

namespace App\Console\Commands;

use App\Jobs\State\StatesSync;
use Illuminate\Console\Command;

class StatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:states-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to save states in the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        StatesSync::dispatch();
    }
}
