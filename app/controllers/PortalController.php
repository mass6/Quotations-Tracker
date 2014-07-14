<?php
/**
 * Created by:
 * User: sam
 * Date: 7/1/14
 * Time: 5:14 PM
 */

use Insight\Repositories\Portal;

class PortalController extends \BaseController {


    /**
     * @return \Illuminate\View\View
     */
    public function getContracts()
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
//        $output = Contract::all();

//        $reportName = 'report-' . str_random() . '.txt';
//        $filepath = 'data/temp/' . $reportName;



        //$contracts = object_to_array(json_decode($output));
        //File::put($filepath, $output);
        return View::make('portal.contracts.index')->with(['reportName' => 'contracts']);
    }

    /**
     * @return string
     */
    public function rebuildContractsIndex()
    {
        // get data from web service
        $url = 'http://basepackage.v2.dev/insight/service.php';
        $data = array('key'=>sha1('?34EC=/$:~8a5~x'), 'queryType' => 'Contracts');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $webcontracts = curl_exec($ch);
        curl_close($ch);

        $updated = array(); // will store web_id's from $webcontracts object

        // loop through each webcontract and either update or create a new record
        foreach (object_to_array(json_decode($webcontracts)) as $webcontract){
            if ($contract = Contract::where('web_id', $webcontract['web_id'])->first()){
                // update existing contract in DB
                Log::info('webcontract #: ' . $webcontract['web_id'] . ' exists in db');
                Log::info($contract['web_id']);
                //$contract->update($webcontract);
            } else {
                // create new contract in DB
                Log::info('Contract not found: ' . $webcontract['web_id'] . '. Creating it now...');
                Contract::create($webcontract);
            }
            $updated[] = $webcontract['web_id'];

        }

        // delete any contracts that no longer exist
        $dbContracts = Contract::all();
        foreach ($dbContracts as $dbContract){
            if (! in_array($dbContract['web_id'], $updated)){
                Log::info('Existing contract ' . $dbContract['web_id'] . ' should be deleted');
                Contract::destroy($dbContract['id']);

            }
        }

        return "done";
    }

    /**
     * @return string
     */
    public function rebuildUsersIndex()
    {
        // get data from web service
        $url = 'http://basepackage.v2.dev/insight/service.php';
        $data = array('key'=>sha1('?34EC=/$:~8a5~x'), 'queryType' => 'Users');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $webusers = curl_exec($ch);
        curl_close($ch);

        return "<pre>{$webusers}</pre>";
        $updated = array(); // will store web_id's from $webusers object

        // loop through each webcontract and either update or create a new record
        foreach (object_to_array(json_decode($webusers)) as $webuser){
            if ($contract = Contract::where('web_id', $webuser['web_id'])->first()){
                // update existing contract in DB
                Log::info('webcontract #: ' . $webcontract['web_id'] . ' exists in db');
                Log::info($contract['web_id']);
                //$contract->update($webcontract);
            } else {
                // create new contract in DB
                Log::info('Contract not found: ' . $webcontract['web_id'] . '. Creating it now...');
                Contract::create($webcontract);
            }
            $updated[] = $webcontract['web_id'];

        }

        // delete any contracts that no longer exist
        $dbContracts = Contract::all();
        foreach ($dbContracts as $dbContract){
            if (! in_array($dbContract['web_id'], $updated)){
                Log::info('Existing contract ' . $dbContract['web_id'] . ' should be deleted');
                Contract::destroy($dbContract['id']);

            }
        }

        return "done";
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getUsers()
    {
        return View::make('portal.users.index', ['heading' => 'Portal Users']);
    }


    /**
     *
     *
     * @return \Illuminate\View\View
     */
    public function getProducts()
    {
        $products = Portal::getReport('products', 'array');
        return View::make('portal.products.index', compact('products'));
    }
    /**
     *
     *
     * @return \Illuminate\View\View
     */
    public function getBudgets()
    {
        return View::make('layouts.partials._placeholder', ['heading' => 'Budgets']);
    }

    public function getApprovals()
    {
        return View::make('layouts.partials._placeholder', ['heading' => 'Approval Statistics']);
    }

    public function getDoa()
    {
        $doa = Portal::getReport('doa', 'array');
        return View::make('portal.doa.index', compact('doa'));
    }

    public function getOrders($period = 'today')
    {
        $parts = explode('-', $period);
        $parts = array_map('ucfirst', $parts);
        $reportName = 'Orders' . implode('', $parts);
        $heading = 'Orders ' . implode(' ', $parts);
        //return $orders = Portal::getReport($period, 'array');
        return View::make('portal.orders.index', compact('reportName', 'heading'));
    }

    public function getOrderDetails($id, $customerGroup = 'emrill')
    {
         $order = Portal::getReport('orderDetails', 'array', 'search', $customerGroup, $id)[0];
        $items = Portal::getReport('orderItemDetails', 'array', 'search', $customerGroup, $id);
        return View::make('portal.orders.show', compact('order', 'items'));
    }

    public function searchOrders($customerGroup = 'emrill')
    {
        $results = null;
        $q = Input::has('q') ? Input::get('q') : null;
        if ($q){
            Log::info(Input::get('q'));
            $results = Portal::getReport('ordersSearch', 'array', 'search', $customerGroup, Input::get('q'));
        }
        return View::make('portal.orders.search', compact('results', 'q'));
    }




} 