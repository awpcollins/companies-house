<?php

namespace Tests\Unit;

use App\Services\Quote as QuoteService;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    public function testNameMatchSuccess(){
        $directorName = 'SIMPSON, Homer';

        $customerName = [
                'firstName' => 'Homer',
                'lastName' => 'Simpson'
        ];

        $quoteService = new QuoteService();

        $this->assertTrue($quoteService->nameMatch($directorName, $customerName));
    }

    public function testNameMatchFailure(){
        $directorName = 'HORSEMAN, Bojack';

        $customerName = [
                'firstName' => 'Homer',
                'lastName' => 'Simpson'
        ];

        $quoteService = new QuoteService();

        $this->assertFalse($quoteService->nameMatch($directorName, $customerName));
    }
}
