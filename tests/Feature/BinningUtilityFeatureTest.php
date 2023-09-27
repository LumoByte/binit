<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\BinningUtility;

class BinningUtilityFeatureTest extends TestCase
{
    
    /** @test */
    public function it_works_when_capitalization_is_mixed()
    {
        $equalFrequency = $this->artisan('discretize equaL-FREQuency 0.1 0.5 1.0 2.3 2.5 3.2')->run();
        $equalWidth = $this->artisan('discretize eQuAl-WiDtH 0.1 0.5 1.0 2.3 2.5 3.2')->run();
        
        // Assert function works without erroring
        $this->assertEquals(0, $equalWidth);
        $this->assertEquals(0, $equalFrequency);
    }

    /** @test */
    public function it_can_perform_equal_width_binning_regardless_of_bin_size()
    {
        $data = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8];
        $numBins = 5;

        $binningUtility = new BinningUtility($data, $numBins);
        $bins = $binningUtility->equalWidthBinning();

        $expected = [
            "(0.1, 0.2]",
            "(0.2, 0.3]",
            "(0.4, 0.5]",
            "(0.5, 0.6]",
            "(0.7, 0.8]"
        ];

        // Assertions for the expected behavior
        $this->assertEquals($expected, $bins);
        $this->assertCount($numBins, $bins);
    }

    /** @test */
    public function it_can_perform_equal_frequency_binning_regardless_of_bin_size()
    {
        $data = [0.1, 3.4, 3.5, 3.6];
        $numBins = 4;

        $binningUtility = new BinningUtility($data, $numBins);
        $bins = $binningUtility->equalFrequencyBinning();

        $expected = [
            "0.1",
            "3.4",
            "3.5",
            "3.6"
        ];

        // Assertions for the expected behavior
        $this->assertEquals($expected, $bins);
        $this->assertCount($numBins, $bins);
    }
}
