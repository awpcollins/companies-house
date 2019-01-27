<?php

namespace App\Http\Controllers;

use App\Services\CompaniesHouse;
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
            return response()->json([
                'success' => false,
                'status' => $results['basic']->getStatusCode(),
            ]);
        }

        // $namesMatch = $this->companiesHouse->checkNames

        return response()->json([
            'success' => true,
        ]);
    }
}
