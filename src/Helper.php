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
    const EXIT_SUCCESS = 0;
    const EXIT_ERROR   = 1;

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
                'code'    => self::EXIT_ERROR,
                'status'  => 'failed',
                'message' => 'Url is Empty'
            ];
        }

        $endpoint = $url . '?' . http_build_query($params);
        $curl     = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "utf-8",
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
                'code'    => self::EXIT_ERROR,
                'status'  => 'failed',
                'message' => $err
            ];
        }

        $res = json_decode($request);

        if (isset($res->result) && $res->result == 'success') {
            return [
                'code'    => self::EXIT_SUCCESS,
                'status'  => 'success',
                'message' => 'Success',
                'rowId'   => isset($res->row) ? $res->row : null
            ];
        }

        return [
            'code'    => self::EXIT_ERROR,
            'status'  => 'failed',
            'message' => 'Error'
        ];
    }
}
