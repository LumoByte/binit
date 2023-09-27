<?php

namespace App\Commands;
use App\BinningUtility;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class DiscretizeCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'discretize {algorithm : The name of the algorithm (required)} {data* : The bins as integers or floats (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Perform binning on the input data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Gather the input
        $rawAlgorithm = $this->argument('algorithm');
        
        // remove special chars & lowercase the input
        $algorithm = strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $rawAlgorithm));

        $data = $this->argument('data');
        
        // Three bins: High, Medium, Low
        $numBins = 3;
        
        // Exception: Only one data set is entered
        if ($numBins <= 1) {
            $this->error('Please enter at least two sets of data as integers or floats.');
            return 1;
        };
        
        $binningUtility = new BinningUtility($data, $numBins);

        // Proceed with user-defined algorithm
        if ($algorithm === 'equal-width') {
            $bins = $binningUtility->equalWidthBinning();
        } elseif ($algorithm === 'equal-frequency') {
            $bins = $binningUtility->equalFrequencyBinning();
        } else {
            $this->error('Invalid algorithm: Please use "equal-width" or "equal-frequency".');
            return 1;
        }

        // Print the binning output
        $this->info("Low: {$bins[0]}");
        $this->info("Medium: {$bins[1]}");
        $this->info("High: {$bins[2]}");
    }
}
