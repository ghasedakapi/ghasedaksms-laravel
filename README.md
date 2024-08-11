<p align="center">  
  <a href="https://github.com/ghasedakapi/ghasedaksms-laravel">  
    <img src="https://raw.githubusercontent.com/ghasedakapi/ghasedak-php/master/g4php.png" alt="Logo" height="200" alt="ghasedak for laravel">  
  </a>  
  
  <h3 align="center">Ghasedak Laravel SDK</h3>  
  
  <p align="center">  
    Easy-to-use SDK for implementing Ghasedak SMS API in your Laravel projects.
    <br />  
    <a href="https://ghasedak.me/php"><strong>Explore the docs »</strong></a>  
    <br />  
    <br />  
    <a href="https://ghasedak.me/developers">Web Service Documents</a>  
    ·  
    <a href="https://ghasedak.me/docs">REST API</a>  
    .  
    <a href="https://github.com/ghasedakapi/ghasedaksms-laravel/issues">Report Bug</a>  
    ·  
    <a href="https://github.com/ghasedakapi/ghasedaksms-laravel/issues">Request Feature</a>  
  </p>  
</p>  

<br>  
<p align="center">
	<a href="https://github.com/ghasedakapi/ghasedaksms-laravel/graphs/contributors"><img src="https://img.shields.io/github/contributors/ghasedakapi/ghasedaksms-laravel.svg" alt="contributors"></a>
	<a href="https://github.com/ghasedakapi/ghasedaksms-laravel/network/members"><img src="https://img.shields.io/github/forks/ghasedakapi/ghasedaksms-laravel.svg" alt="forks"></a>
	<a href="https://github.com/ghasedakapi/ghasedaksms-laravel/stargazers"><img src="https://img.shields.io/github/stars/ghasedakapi/ghasedaksms-laravel.svg" alt="stars"></a>
	<a href="https://github.com/ghasedakapi/ghasedaksms-laravel/issues"><img src="https://img.shields.io/github/issues/ghasedakapi/ghasedaksms-laravel.svg" alt="issues"></a>
	<a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-green.svg" alt="license"></a>
</p>

<p align="center">  
    <a href="#table-of-contents">English Document</a>
</p>  

## Table of Contents  
  
* [Install](#install)
* [Usage](#usage)   
* [Licence](#license)


## Installation

You can install the package via composer:

```bash
composer require ghasedaksms/ghasedaksms-laravel
```

## Usage

1- Put your apikey in .env file:

```php
GHASEDAK_SMS_API_KEY="b7ee4eace78************************************************"
```

2- Create a notification (for example SendOtpToUser):

```
php artisan make:notification SendOtpToUser
```

3- Extend SendOtpToUser from GhasedaksmsBaseNotification and fill toGhasedaksms function with DTOs:

```php
<?php

namespace App\Notifications;

use Carbon\Carbon;
use Ghasedak\DataTransferObjects\Request\InputDTO;
use Ghasedak\DataTransferObjects\Request\ReceptorDTO;
use Ghasedaksms\GhasedaksmsLaravel\Message\GhasedaksmsVerifyLookUp;
use Ghasedaksms\GhasedaksmsLaravel\Notification\GhasedaksmsBaseNotification;
use Illuminate\Bus\Queueable;

class SendOtpToUser extends GhasedaksmsBaseNotification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function toGhasedaksms($notifiable): GhasedaksmsVerifyLookUp
    {
        $message = new GhasedaksmsVerifyLookUp();
        $message->setSendDate(Carbon::now());
        $message->setReceptors([new ReceptorDTO($notifiable->mobile, 'client referenceId')]);
        $message->setTemplateName('newOTP');
        $message->setInputs([new InputDTO('code', '******')]);
        return $message;
    }
}
```

4- Use SendOtpToUser

```php
$user = new \App\Models\User();
$user->mobile = '0912*******';
$user->notify(new \App\Notifications\SendOtpToUser());
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mortezaei76@gmail.com instead of using the issue tracker.

## Credits

-   [mrt](https://github.com/ghasedaksms)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
