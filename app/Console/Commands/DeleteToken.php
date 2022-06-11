<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\Sanctum;

class DeleteToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes the expired sanctum token';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
/*         if ($expiration = config('sanctum.expiration')) {
            $model = Sanctum::$personalAccessTokenModel;

            $hours = $this->option('hours');

            $model::where('created_at', '<', now()->subMinutes($expiration  *//* + ($hours * 60) *//* ))->delete();

            $this->info("Tokens expired for more than {$hours} hours pruned successfully.");

            return 0;
        }

        $this->warn('Expiration value not specified in configuration file.');

        return 1; */

        $expiration=config('sanctum.expiration');

        $model=Sanctum::$personalAccessTokenModel;

        $model::where('created_at','<',now()->subMinutes($expiration))->delete();

        echo "expired tokens are deleted";
    }
}
