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

    public function index(Request $request)
    {
        $results = $this->companiesHouse->getCompanyInfo($request->input('companyNumber'));

        if ($results['basic']->getStatusCode() !== 200 || $results['officers']->getStatusCode() !== 200) {
            return response()->setStatusCode($results['basic']->getStatusCode());
        }

        $quote = new QuoteService();

        $companyOfficers = json_decode($results['officers']->getBody()->getContents());

        dd($companyOfficers->items[0]->name);

        $nameMatch = $quote->nameMatch($companyOfficers->items[0]->name, $request->input('customerName'));

        if(!$nameMatch){
            return response()->json([
                'msg' => 'This insurance must be applied for by the company director'
            ])->setStatusCode(400);
        }

        $companyInfo = json_decode($results['basic']->getBody()->getContents());

        return response()->json([
            'success' => $quote->calculateResults($companyInfo),
        ]);
    }
}
