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

    const REQUEST_TIMEOUT = 30;
    const PORT_SSL        = 443;
    const PORT_HTTP       = 80;

    const RESPONSE_SUCCESS = [
        'code'    => self::EXIT_SUCCESS,
        'status'  => 'success',
        'message' => 'Success',
    ];
    const RESPONSE_FAILED  = [
        'code'    => self::EXIT_ERROR,
        'status'  => 'failed',
        'message' => 'Error'
    ];

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

        if (isset($res->result) && $res->result === 'success') {
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

    /**
     * Hàm gọi 1 async GET Request để không delay Main Process
     *
     * @param string $url Url Endpoint
     *
     * @return array TRUE nếu thành công, FALSE nếu thất bại
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/16/18 17:15
     */
    public static function backgroundHttpGet($url)
    {
        $parts = parse_url($url);
        if (strtolower($parts['scheme']) === 'https') {
            $fp = fsockopen('ssl://' . $parts['host'], isset($parts['port']) ? $parts['port'] : self::PORT_SSL, $errno, $errStr, self::REQUEST_TIMEOUT);
        } else {
            $fp = fsockopen($parts['host'], isset($parts['port']) ? $parts['port'] : self::PORT_HTTP, $errno, $errStr, self::REQUEST_TIMEOUT);
        }
        if (!$fp) {
            if (function_exists('log_message')) {
                log_message('error', "ERROR: " . json_encode($errno) . " - " . json_encode($errStr));
            }

            return self::RESPONSE_FAILED;
        }

        $out = "GET " . $parts['path'] . "?" . $parts['query'] . " HTTP/1.1\r\n";
        $out .= "Host: " . $parts['host'] . "\r\n";
        $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out .= "Connection: Close\r\n\r\n";
        fwrite($fp, $out);
        fclose($fp);

        return self::RESPONSE_SUCCESS;
    }
}
