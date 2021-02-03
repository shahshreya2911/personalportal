<?php
namespace Vanguard\Http\Controllers\Web;
use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Analytics;
use Vanguard\Libraries\GoogleAnalytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
class HomeController extends Controller
{ 
	public function googleAnalytics(){
      //   $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
       
        $startDate = Carbon::now()->subYear();
$endDate = Carbon::now();

$deata = Period::create($startDate, $endDate);
 //dd($deata);
 $result = GoogleAnalytics::topCountries();
        $country = $result->pluck('country');
        $country_sessions = $result->pluck('sessions');
        $analyticsData = Analytics::performQuery(
    Period::years(1),
    'ga',
    [
        'metrics' => 'ga:sessions',
         "start-date"=>"10daysAgo",
      	"end-date"=> "yesterday",
        'dimensions' => 'ga:date'
    ]
);
   $analyticsData=   json_encode($analyticsData->rows);
return view('analytics.linechart', compact('analyticsData'));
        
       // return view('analytics.canvas', compact('country', 'country_sessions'));
    }
         //to get the summary of google analytics.
  
}