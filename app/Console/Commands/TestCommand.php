<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestCommand extends Command
{
    protected $signature = 'dev-test';
    protected $description = '';

    public function handle()
    {
        $this->info(Hash::make('global101'));
    }
}
