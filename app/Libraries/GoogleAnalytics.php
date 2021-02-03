<?php 
namespace Vanguard\Libraries;

use Analytics;
use Spatie\Analytics\Period;

class GoogleAnalytics{

    static function topCountries() {
        $country = Analytics::performQuery(Period::days(30),'ga:sessions',  ['dimensions'=>'ga:country','sort'=>'-ga:sessions']);
        $result= collect($country['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'country' =>  $dateRow[0],
                'sessions' => (int) $dateRow[1],
            ];
        });
        
        return $result;
    }

    static function topBrowsers()
    {
        //
    }

}