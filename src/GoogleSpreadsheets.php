<?php
/**
 * Project spreadsheets-basic
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/04/2021
 * Time: 02:22
 */

namespace nguyenanhung\Google\Basic\Spreadsheets;

/**
 * Class GoogleSpreadsheets
 *
 * @package   nguyenanhung\Google\Basic\Spreadsheets
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class GoogleSpreadsheets
{
    const SCRIPT_API = 'https://script.google.com/macros/s/{{SCRIPT_ID}}/exec';
    const ID_PATTERN = '{{SCRIPT_ID}}';

    /** @var mixed $response */
    protected $response;

    /** @var string $scriptId */
    protected $scriptId;

    /** @var array $contentData */
    protected $contentData;

    /** @var bool $backgroundRequest */
    protected $backgroundRequest;

    /**
     * Function setBackgroundRequest - Lựa chọn gọi 1 async GET Request để không delay Main Process
     *
     * @param bool $backgroundRequest
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/06/2021 49:14
     */
    public function setBackgroundRequest($backgroundRequest = true)
    {
        $this->backgroundRequest = $backgroundRequest;

        return $this;
    }

    /**
     * Function setScriptId
     *
     * @param string $scriptId
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/04/2021 25:02
     */
    public function setScriptId($scriptId = '')
    {
        $this->scriptId = $scriptId;

        return $this;
    }

    /**
     * Function setContentData
     *
     * @param array $contentData
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/04/2021 32:26
     */
    public function setContentData($contentData = [])
    {
        $this->contentData = $contentData;

        return $this;
    }

    /**
     * Function getResponse
     *
     * @return mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/04/2021 37:46
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Function push
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/04/2021 38:44
     */
    public function push()
    {
        if (empty($this->scriptId) || empty($this->contentData)) {
            $this->response = null;
        } else {
            $scriptUrl = str_replace(self::ID_PATTERN, $this->scriptId, self::SCRIPT_API);
            if ($this->backgroundRequest === true) {
                /**
                 * Async GET Request để không delay Main Process
                 * Lưu ý: Cách gọi này không chắc chắn được việc request tới Google có thành công thật sự hay không
                 */
                $this->response = Helper::backgroundHttpGet($scriptUrl . '?' . http_build_query($this->contentData));
            } else {
                $this->response = Helper::sendToSpreadsheets($scriptUrl, $this->contentData);
            }
        }

        return $this;
    }
}
