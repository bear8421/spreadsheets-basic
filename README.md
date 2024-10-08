# Google Spreadsheets - Basic Level

[![Latest Stable Version](https://img.shields.io/packagist/v/bear8421/spreadsheets-basic.svg?style=flat-square)](https://packagist.org/packages/bear8421/spreadsheets-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/bear8421/spreadsheets-basic.svg?style=flat-square)](https://packagist.org/packages/bear8421/spreadsheets-basic)
[![Daily Downloads](https://img.shields.io/packagist/dd/bear8421/spreadsheets-basic.svg?style=flat-square)](https://packagist.org/packages/bear8421/spreadsheets-basic)
[![Monthly Downloads](https://img.shields.io/packagist/dm/bear8421/spreadsheets-basic.svg?style=flat-square)](https://packagist.org/packages/bear8421/spreadsheets-basic)
[![License](https://img.shields.io/packagist/l/bear8421/spreadsheets-basic.svg?style=flat-square)](https://packagist.org/packages/bear8421/spreadsheets-basic)
[![PHP Version Require](https://img.shields.io/packagist/dependency-v/bear8421/spreadsheets-basic/php)](https://packagist.org/packages/bear8421/spreadsheets-basic)

1 thư viện nhỏ hỗ trợ việc đẩy dữ liệu lên Google Spreadsheets để làm Data thông qua Google Sheet API.

## Lưu ý

Thư viện này chỉ nên đáp ứng những project nhỏ, làm việc với 1-2 file sheet ở cấp độ vừa và nhỏ

Nếu cần nhiều tính năng hơn, hãy làm việc với Google Sheet API trên Google Cloud Platform - Tham khảo tài liệu tại đây: https://developers.google.com/sheets/api

## Version

Thư viện hỗ trợ 2 phiên bản song song, tùy thuộc vào phiên bản PHP của bạn sử dụng là gì để sử dụng cho thích hợp và tối ưu nhất

- [x] v1.x support all PHP version `>=5.4`
- [x] v2.x support all PHP version `>=7.0`

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
