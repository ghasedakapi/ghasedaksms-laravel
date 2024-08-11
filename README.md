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
