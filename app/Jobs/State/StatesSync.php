<?php

namespace App\Jobs\State;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class StatesSync implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
    */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiStates = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados");

        foreach ($apiStates->json() as $state) {
            StateStore::dispatch($state);
        }
    }
}
