<?php

namespace App\Services;

class Quote
{
    const SCORE_MAX = 3;

     /**
     * Compares two names to see if match is reasonable
     *
     * @return Boolean
     */
    public function nameMatch($directorName, $customerName)
    {
       $nameArr = explode(' ', $directorName);
       $lastName = rtrim(strtolower($nameArr[0]), ',');
       $firstName = strtolower($nameArr[1]);

       if(strtolower($customerName['lastName']) === $lastName && strtolower($customerName['firstName']) === $firstName){
           return true;
       }

       return false;
    }

    /**
     * Calculate if customer is eligible for a quote
     *
     * @return Boolean
     */
    public function calculateResults($companyInfo) {
        $riskScore = 0;

        if ($companyInfo->has_insolvency_history) {
            $riskScore++;
        }

        if ($companyInfo->has_charges) {
            $riskScore++;
        }

        if ($companyInfo->registered_office_is_in_dispute) {
            $riskScore++;
        }

        if($riskScore > self::SCORE_MAX){
            return false;
        }

        return true;
    }
}
