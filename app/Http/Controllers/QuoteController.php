<?php

namespace App\Http\Controllers;

use App\Services\CompaniesHouse;
use App\Services\Quote as QuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * CompaniesHouse
     *
     * @var CompaniesHouse
     */
    protected $companiesHouse;

    public function __construct(CompaniesHouse $companiesHouse)
    {
        $this->companiesHouse = $companiesHouse;
    }

    public function getQuote(Request $request)
    {
        $results = $this->companiesHouse->getCompanyInfo($request->input('companyNumber'));

        if ($results['basic']->getStatusCode() !== 200) {
            return response()->json($results['basic']->getReasonPhrase(), $results['basic']->getStatusCode());
        }

        $quote = new QuoteService();

        $companyOfficers = json_decode($results['officers']->getBody()->getContents());
        $nameMatch = $quote->nameMatch($companyOfficers->items[0]->name, $request->input('customerName'));

        if(!$nameMatch){
            return response()->json("Customer and director name don't seem to be a match, please try again.", 400);
        }

        $companyInfo = json_decode($results['basic']->getBody()->getContents());

        return response()->json([
            'success' => $quote->calculateResults($companyInfo),
        ]);
    }
}
