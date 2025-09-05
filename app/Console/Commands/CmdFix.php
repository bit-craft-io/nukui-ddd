<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CmdFix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cmd:fix {--stan-only} {--unit-only}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'codebase and looks for both obvious and tricky bugs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $commands = [
            'stan-only' => './vendor/bin/phpstan analyse --memory-limit=1024M',
            'unit-only' => './vendor/bin/phpunit tests',
        ];

        $command = '';
        foreach ($this->options() as $key => $option) {
            if ($option) {
                $command = $commands[$key];
                break;
            }
        }

        if ($command) {
            $commands = [$command];
        }

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
