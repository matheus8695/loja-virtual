<?php

namespace App\Jobs\State;

use App\Models\State;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class StateStore implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     * @param array<string> $state
     */
    public function __construct(public array $state)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        State::updateOrCreate([
            "ibge_code" => $this->state["id"],
            "acronym"   => $this->state["sigla"],
            "name"      => $this->state["nome"],
        ]);
    }
}
