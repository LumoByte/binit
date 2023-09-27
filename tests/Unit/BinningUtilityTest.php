<?php
use Tests\TestCase;
use App\BinningUtility;

class BinningUtilityTest extends TestCase
{
    /** @test */
    public function it_can_perform_equal_width_binning()
    {
        $numBins = 3;
        $binningUtility = new BinningUtility([0.5, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 4.5, 5.0, 5.5, 6.0], $numBins);
        $bins = $binningUtility->equalWidthBinning();

        $expected = [
            "(0.5, 2.3]",
            "(2.3, 4.1]",
            "(4.2, 6]",
        ];
        // Test the assertion
        $this->assertEquals($expected, $bins);
    }

    /** @test */
    public function it_can_perform_equal_frequency_binning()
    {
        $numBins = 3;
        $binningUtility = new BinningUtility([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 10.5, 11], $numBins);
        $bins = $binningUtility->equalFrequencyBinning();

        $expected = [
            "1, 2, 3, 4",
            "5, 6, 7, 8",
            "9, 10, 10.5, 11"
        ];
        // Test the assertion
        $this->assertEquals($expected, $bins);
    }
}