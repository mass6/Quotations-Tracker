<?php

use Insight\Repositories\Portal;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		return View::make('home', array('title' => 'Quotations - Home') );
	}

	public function getDashboard()
	{
        $ordersTodaySum = Portal::getReport('OrdersTodaySum', 'array')[0];
        $ordersPendingApproval = Portal::getReport('OrdersPendingApprovalSum', 'array')[0];
        $currentMonthsOrders = Portal::getReport('CurrentMonthsOrdersSum', 'array')[0];
        $dailyOrderTotalsThisMonth = Portal::getReport('DailyOrderTotalsThisMonth', 'array');
        $thirdPartyOrdersThisMonthSum = Portal::getReport('ThirdPartyOrdersThisMonthSum', 'array')[0];
        $spendPerCategoryThisMonthSum = Portal::getReport('SpendPerCategoryThisMonthSum', 'array');

        JavaScript::put([
            'ordersTodayCount' => $ordersTodaySum['count'],
            'ordersTodayValue' => $ordersTodaySum['sum'],
            'pendingApprovalCount' => $ordersPendingApproval['count'],
            'pendingApprovalValue' => $ordersPendingApproval['sum'],
            'monthlyOrderCount' => $currentMonthsOrders['count'],
            'monthlyOrderValue' => $currentMonthsOrders['sum'],
            'dailyOrderTotals' => $dailyOrderTotalsThisMonth,
            'thirdPartyOrderCount' => $thirdPartyOrdersThisMonthSum['count'],
            'thirdPartyOrderValue' => $thirdPartyOrdersThisMonthSum['sum'],
            'spendPerCategory' => $spendPerCategoryThisMonthSum
        ]);
		return View::make('dashboards.dashboard4', array('title' => 'Dashboards') );
	}

    public function getReport()
	{
        //return 'wokkss';
        //$output = file_get_contents('http://36sdemo.net/insight-ws.php?user=samsnead&key=sc121212');
        //$output = shell_exec('http://36sdemo.net/insight-ws.php?user=samsnead&key=sc121212');
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "http://basepackage.v2.dev/insight/insight-ws.php?user=samsnead&key=sc121212");
//        curl_setopt($ch, CURLOPT_HEADER, 'Content-type: application/json');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//        $output = curl_exec($ch);
//        curl_close($ch);
//
//        $reportName = 'report-' . str_random() . '.txt';
//        $filepath = 'data/temp/' . $reportName;
//
//        return $contracts = object_to_array(json_decode($output));
//        File::put($filepath, $output);
//        return View::make('contracts.index', compact('contracts', 'reportName'));

        $report = Portal::getReport('OrdersYesterday', 'array');
        return $report;
	}

    public function testService()
    {
        //$url = 'http://localhost/service.php';
        $url = 'http://basepackage.v2.dev/insight/service.php';
        $data = array('key'=>sha1('?34EC=/$:~8a5~x'), 'queryType' => 'Contracts');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        //return object_to_array(json_decode(object_to_array($response)));
        return "<pre>$response</pre>" ;

    }


}
