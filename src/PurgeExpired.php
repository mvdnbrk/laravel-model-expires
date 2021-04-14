<?php

namespace Mvdnbrk\EloquentExpirable;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PurgeExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expirable:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the expired records.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Deleting expired records...');
        $this->line('');

        foreach (config('expirable.purge', []) as $purgeable) {

            if (in_array('Mvdnbrk\EloquentExpirable\Expirable', class_uses($purgeable))) {

                $total = call_user_func($purgeable . '::onlyExpired')->forceDelete();

                $this->line($purgeable . ': ');

                if ($total > 0) {
                    $this->info($total . ' ' . Str::plural('record', $total) . ' deleted.');
                } else {
                    $this->comment('Nothing to delete.');
                }
            } else {

                $this->error($purgeable . ': this model is not expirable! (Expirable trait not found)');
            }

            $this->line('');
        }

        $this->info('Purge completed!');
    }
}
