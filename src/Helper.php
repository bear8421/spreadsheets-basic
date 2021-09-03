<?php
/**
 * Project spreadsheets-basic
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/04/2021
 * Time: 02:25
 */

namespace nguyenanhung\Google\Basic\Spreadsheets;

/**
 * Class Helper
 *
 * @package   nguyenanhung\Google\Basic\Spreadsheets
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Helper
{
    /**
     * Function sendToSpreadsheets
     *
     * @param string $url
     * @param array  $params
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/04/2021 30:36
     */
    public static function sendToSpreadsheets($url = '', $params = [])
    {
        if (empty($url)) {
            return [
                'code'    => 1,
                'status'  => 'failed',
                'message' => 'Url is Empty'
            ];
        }

        $endpoint = $url . '?' . http_build_query($params);
        $curl     = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
        ]);

        $request = curl_exec($curl);
        $err     = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return [
                'code'    => 1,
                'status'  => 'failed',
                'message' => $err
            ];
        }

        $res = json_decode($request);

        if (isset($res->result) && $res->result == 'success') {
            return [
                'code'    => 0,
                'status'  => 'success',
                'message' => 'Success',
                'rowId'   => isset($res->row) ? $res->row : ''
            ];
        }

        return [
            'code'    => 1,
            'status'  => 'failed',
            'message' => 'Error'
        ];
    }
}
