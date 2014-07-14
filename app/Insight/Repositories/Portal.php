<?php  namespace Insight\Repositories; /***
 * Created by:
 * User: sam
 * Date: 7/7/14
 * Time: 9:55 PM
 */
use \Log;
class Portal 
{


    /**
     * Posts to the portal web service and returns a JSON response
     *
     * @param $query
     * @param string $format
     * @param string $type
     * @param $group
     * @param null $search
     * @return array|mixed
     */
    public static function getReport($query, $format = 'json', $type = 'query', $group = 'emrill', $search = null)
    {
        $data = array('key'=>sha1(getenv('WS_KEY')), 'queryName' => ucwords($query), 'queryType' => $type, 'group' => $group, 'search' => $search);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, getenv('WS_URL'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        Log::info($response);
        if ($format !== 'json'){
            return object_to_array(json_decode($response));
        }
        return $response;

    }

} 