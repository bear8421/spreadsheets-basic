# Google Spreadsheets - Basic Level

[![Latest Stable Version](http://poser.pugx.org/bear8421/spreadsheets-basic/v)](https://packagist.org/packages/bear8421/spreadsheets-basic) [![Total Downloads](http://poser.pugx.org/bear8421/spreadsheets-basic/downloads)](https://packagist.org/packages/bear8421/spreadsheets-basic) [![Latest Unstable Version](http://poser.pugx.org/bear8421/spreadsheets-basic/v/unstable)](https://packagist.org/packages/bear8421/spreadsheets-basic) [![License](http://poser.pugx.org/bear8421/spreadsheets-basic/license)](https://packagist.org/packages/bear8421/spreadsheets-basic)

1 thư viện nhỏ hỗ trợ việc đẩy dữ liệu lên Google Spreadsheets để làm Data thông qua Google Sheet API.

## Lưu ý

Thư viện này chỉ nên đáp ứng những project nhỏ, làm việc với 1-2 file sheet ở cấp độ vừa và nhỏ

Nếu cần nhiều tính năng hơn, hãy làm việc với Google Sheet API trên Google Cloud Platform - Tham khảo tài liệu tại đây: https://developers.google.com/sheets/api

## Cài đặt thư viện

Thư viện này được cài đặt thông qua Composer

```shell
composer require bear8421/spreadsheets-basic
```

```php
<?php
require_once __DIR__.'/vendor/autoload.php';
use nguyenanhung\Google\Basic\Spreadsheets\GoogleSpreadsheets;

$scriptId = '1234';
$contentData = [
'Column1_1' => 1,
'Column1_2' => 2,
];
$spreadsheets = new GoogleSpreadsheets();
$spreadsheets->setScriptId('1234')
->setContentData($contentData)
->push();


```

## Liên hệ & Hỗ trợ

| Name        | Email                | Skype            | Facebook      |
| ----------- | -------------------- | ---------------- | ------------- |
| Hung Nguyen | dev@nguyenanhung.com | nguyenanhung5891 | @nguyenanhung |

From Vietnam with Love <3