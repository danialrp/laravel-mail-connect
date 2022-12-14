# Laravel Email Connect (IMAP)

[![Latest Release on Packagist](https://img.shields.io/packagist/v/danialpanah/mail-connect.svg?style=flat-square)](https://packagist.org/packages/danialpanah/mail-connect)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

- [Introduction](#introduction)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Support & Security](#support-security)
- [License](#license)
- [ToDo](#todo)

<a name="introduction"></a>

## Introduction

This Laravel package can open any Email Mailbox and access to its directories like inbox, sent items etc. Current
version can only use the Imap protocol (PHP Imap), in the future releases using POP3 protocol will be added.

<a name="installation"></a>

## Installation

* Use following command to install:

```bash
composer require danialpanah/mail-connect
```

**This package supports Laravel auto-discovery feature. If you are using Laravel 6.x or greater no need to do any
further actions, otherwise follow below steps to add this package manually to your application.**

* Add the service provider to your `providers[]` array in `config/app.php` in your laravel application:

```php
DanialPanah\MailConnect\MailConnectServiceProvider::class
```

* For using Laravel Facade add the alias to your `aliases[]` array in `config/app.php` in your Laravel application:

```php
'MailConnect': DanialPanah\MailConnect\Facades\MailConnect::class
```

<a name="configuration"></a>

## Configuration

* After installation, you need to add your Email settings. You can update **config/mailconnect.php** published file or
  in you Laravel **.env** file.

* Run the following command to publish the configuration file:

```bash
php artisan vendor:publish --provider "DanialPanah\MailConnect\MailConnectServiceProvider"
```

* **config/webpay.php**

```bash
return [
    'email_url' => env('MAIL_CONNECT_URL', null),
    'email_username' => env('MAIL_CONNECT_USERNAME', null),
    'email_password' => env('MAIL_CONNECT_PASSWORD', null)
];
```

* Add this to `.env.example` and `.env` files:

```
#Email Connect Settings

#your Imap email url e.g "{localhost:993/imap/ssl/novalidate-cert}"
MAIL_CONNECT_URL=

#your email username (could be same as your email address or any other username) e.g "me@danialrp.com"
MAIL_CONNECT_USERNAME=

#your email password
MAIL_CONNECT_USERNAME=
```

<a name="usage"></a>

## Usage

Following are some examples which you can use to initiate connection to your mailbox:

* Open Imap connection and access to your mailbox contents:

```
// Importing the class namespaces before using it
use DanialPanah\MailConnect\MailConnect;

$mailConnect = new MailConnect();

$mailConnect->protocol = 'imap'; //select protocol
$mailConnect->directory = 'inbox'; //'inbox', 'sent' etc. see allowed Imap directories.
$mailConnect->criteria = 'all'; //'all', 'seen', 'unseen' etc. see allowed Imap criteria.

$messages = $mailConnect->openMailbox(); // get mailbox messages.


// Also Could be used with PHP method chaining 
$messages = $mailConnect
                 ->protocol('imap')
                 ->directory('inbox')
                 ->criteria('all')
                 ->openMailbox();
```

* Using Facades :

```
use DanialPanah\MailConnect\MailConnect;

$messages = MailConnect::openMailbox();
```

* Sample Response of Verify Successful Payment:

```
array [
  0 => array:3 [
    "message_number" => 18
    "header" => array [
      "date" => "Wed, 14 Dec 2022 14:26:44 +0000"
      "subject" => "Some Subject"
      "message_id" => "<B92423C93DB34E729956B11C1FE1878E1D90FC80AD1C@JOBS.360-CONSULTING.DE>"
      "toaddress" => "Danial Panah <me@danialrp.com>"
      "fromaddress" => "From Address <sender@email.com>"
      "reply_toaddress" => "Reply To Address <sender@email.com>"
      "senderaddress" => "Sender Address <sender@email.com>"
      "Recent" => ""
      "Unseen" => ""
      "Flagged" => ""
      "Answered" => ""
      "Deleted" => ""
      "Draft" => ""
      "Msgno" => "  18"
      "MailDate" => "14-Dec-2022 14:48:16 +0000"
      "Size" => "11566"
      "udate" => "1671029296"
    ]
    "body" => "Html Body Message"
  ]
  1 => array:3 [▶]
  2 => array:3 [▶]
  3 => array:3 [▶]
  4 => array:3 [▶]
  5 => array:3 [▶]
``` 

* Laravel Sample Controller:

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DanialPanah\MailConnect\MailConnect;

class MailboxController extends Controller
{   
     public function MyMailbox(): View
    {
        $messages = $mailConnect
                        ->protocol('imap')
                        ->directory('inbox')
                        ->criteria('all')
                        ->openMailbox();

        return view('emails_inbox', ['messages' => $messages]);
    }
}

```

<a name="support-security"></a>

## Support & Security

This package supports Laravel 8 or greater with PHP 8.0 and above.

* In case of discovering any issues, please create one on
  the [Issues](https://github.com/danialrp/laravel-webpay/issues) section.
* For contribution, fork this repo and implements your code then create a PR.

<a name="license"></a>

## License

This repository is an open-source software under the [MIT](https://choosealicense.com/licenses/mit/) license.

<a name="todo"></a>

## ToDo
* Write tests.
* Add POP3 protocol.

