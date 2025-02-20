<?php

namespace App\Console\Commands;

use App\Jobs\Product\ProductsSync;
use Illuminate\Console\Command;

class ProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:products-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        ProductsSync::dispatch();
    }
}
