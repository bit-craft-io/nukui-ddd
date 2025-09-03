<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CmdFormat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cmd:format {--dry-run} {--run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'code format';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $option = '';
        $flag = false;
        foreach (['dry-run', 'd', 'run', 'r'] as $kry) {
            if (array_key_exists($kry, $this->option())) {
                $flag = true;
                if (in_array($kry, ['dry-run', 'd'])) {
                    $option = '--dry-run';
                }
                break;
            }
        }
        if (!$flag) {
            echo 'Usage: php artisan cmd:format [options]' . PHP_EOL;;
            echo '  -d, --dry-run                    format file and not update.' . PHP_EOL;;
            echo '  -r, --run                        format file and update.' . PHP_EOL;
            exit;
        }

        $commands = [
            'rm ./.php-cs-fixer.cache',
            "./vendor/bin/php-cs-fixer fix {$option} ./app",
        ];

        foreach ($commands as $command) {
            echo($command) . PHP_EOL;

            $results = [];
            exec($command, $results);
            foreach ($results as $result) {
                if (!empty(trim($result))) {
                    echo(trim($result)) . PHP_EOL;
                }
            };
        }
        return CommandAlias::SUCCESS;
    }
}
