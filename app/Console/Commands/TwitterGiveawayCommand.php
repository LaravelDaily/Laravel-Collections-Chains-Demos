<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TwitterGiveawayCommand extends Command
{
    protected $signature = 'twitter:giveaway {--exclude=*}';

    public function handle()
    {
        $excluded = collect($this->option('exclude'))
            ->push('povilaskorop', '@dailylaravel')
            ->map(fn (string $name): string => str_replace('@', '', $name))
            ->implode(', ');

        info(sprintf('Users excluded: %s', $excluded));
        $this->info(sprintf('Users excluded: %s', $excluded));

        return 0;
    }
}
