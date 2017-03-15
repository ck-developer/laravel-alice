<?php

namespace Ck\Laravel\Alice\Command;

use Illuminate\Console\Command;

class SeedCommand extends Command
{
    protected $name = 'seed:fixtures';

    public function fire()
    {
        $this->info('ok');
    }
}
