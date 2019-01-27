<?php

namespace App\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise;

class CompaniesHouse
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * CompaniesHouse constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Fetches company information.
     *
     * @param string $companyNumber
     *
     * @return null|array
     */
    public function getCompanyInfo($companyNumber)
    {
        $promises = [
            'basic' => $this->client->getAsync("/company/{$companyNumber}"),
            'officers'   => $this->client->getAsync("/company/{$companyNumber}/officers"),
        ];

        return Promise\unwrap($promises);
    }
}
