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

        // ALTERNATIVE - WITH ARRAYS
        /*
        $exclude = $this->option('exclude');
        array_push($exclude, 'povilaskorop', '@dailylaravel');
        $excluded = implode(', ',
            array_map(fn ($item) => str_replace('@', '', $item), $exclude));
        */

        info(sprintf('Users excluded: %s', $excluded));
        $this->info(sprintf('Users excluded: %s', $excluded));

        return 0;
    }
}
