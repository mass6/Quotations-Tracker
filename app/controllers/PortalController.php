<?php
/**
 * Created by:
 * User: sam
 * Date: 7/1/14
 * Time: 5:14 PM
 */

class PortalController extends \BaseController {

    public function getContracts()
    {
        //return 'wokkss';
        //$output = file_get_contents('http://36sdemo.net/insight-ws.php?user=samsnead&key=sc121212');
        //$output = shell_exec('http://36sdemo.net/insight-ws.php?user=samsnead&key=sc121212');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://basepackage.v2.dev/insight/insight-ws.php?user=samsnead&key=sc121212");
        curl_setopt($ch, CURLOPT_HEADER, 'Content-type: application/json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);

        $reportName = 'report-' . str_random() . '.txt';
        $filepath = 'data/temp/' . $reportName;

        $contracts = object_to_array(json_decode($output));
        File::put($filepath, $output);
        return View::make('contracts.index', compact('contracts', 'reportName'));
    }

    public function getUsers()
    {
        return View::make('layouts.partials._placeholder', ['heading' => 'Portal Users']);
    }

} 