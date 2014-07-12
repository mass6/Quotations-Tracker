<?php
/**
 * Created by:
 * User: sam
 * Date: 7/6/14
 * Time: 5:21 PM
 */

use Insight\Repositories\Portal;

/**
 * Class AjaxController
 */
class AjaxController extends \BaseController
{


    /**
     * Receives and ajax request from Datatables and passes it the Portal web service
     * and returns the JSON response
     *
     * @param $report
     * @return array|mixed
     */
    public function getReport($report)
    {
        if (Request::ajax())
        {
            return Portal::getReport($report, 'json');
        }
    }

}