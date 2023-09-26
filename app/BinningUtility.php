<?php

namespace App;

class BinningUtility
{
    protected $data; // Input data array
    protected $numBins; // Number of bins

    public function __construct(array $data, int $numBins)
    {
        $this->data = $data;
        $this->numBins = $numBins;
    }

    // Process Equal Width Binning
    public function equalWidthBinning()
    {
        sort($this->data); // Sort the data

        $minValue = min($this->data);
        $maxValue = max($this->data);

        $binWidth = ($maxValue - $minValue) / $this->numBins;
        $bins = [];

        // Place values in their respective bins
        for ($i = 0; $i < $this->numBins; $i++) {
            $sharpStart = $minValue + ($i * $binWidth);
            $start = round($sharpStart, 1); // round to nearest tenth

            $sharpEnd = $start + $binWidth;
            $end = round($sharpEnd, 1); // round to nearest tenth

            $bins[] = "($start, $end]";
        }

        return $bins;
    }

    // Process Equal Frequency Binning
    public function equalFrequencyBinning()
    {
        $dataCount = count($this->data);
        $binLimit = (int) ceil($dataCount / $this->numBins); // no. of items per bin (rounded to nearest whole #)

        $bins = [];
        $binIndex = 0;

        // Loop through user input data
        foreach ($this->data as $value) {
            // binIndex increments if items reach binLimit
            if (isset($bins[$binIndex]) && count($bins[$binIndex]) >= $binLimit) {
                $binIndex++;
            }
            // binLimit not set
            if (!isset($bins[$binIndex])) {
                $bins[$binIndex] = [];
            }
            $bins[$binIndex][] = $value; // assign the value to the $binIndex
        }
        
        $result = [];
        // Reorganize array for printing
        foreach ($bins as $binItem) {
            // Implode to concatenate the values within each binItem
            $result[] = implode(', ', $binItem);
        }
        
        return $result;
        
    }
    
}