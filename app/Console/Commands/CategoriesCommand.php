<?php

namespace App\Console\Commands;

use App\Jobs\Product\CategoriesStore;
use Illuminate\Console\Command;

class CategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:categories-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to save product categories in the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        CategoriesStore::dispatch();
    }
}
