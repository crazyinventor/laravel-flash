# Laravel Flash

Flash message package for Laravel

## Installation

Run 'composer require crazyinventor/laflash' or modify your composer.json:
```json
{
    "require": {
        "crazyinventor/laflash": "*"
    }
}
```

## Configuration

Publish the `flash` configuration file by running the following command from a shell inside your Laravel's installation directory:

```
php artisan vendor:publish
```

This will create the file `config/flash.php` in your Laravel's installation directory. You can customize the levels you would like to use.

#### Laravel 5.0

In `/config/app.php`, add the following to `providers`:
```
'CrazyInventor\LaFlash\FlashServiceProvider',
```
and the following to `aliases`:
```
'Flash' => 'CrazyInventor\LaFlash\FlashFacade',
```

#### Laravel 5.1 and newer

In `/config/app.php`, add the following to `providers`:
```
CrazyInventor\LaFlash\FlashServiceProvider::class,
```
and the following to `aliases`:
```
'Flash' => CrazyInventor\LaFlash\FlashFacade::class,
```

## Usage

### Flash::hasMessages($level = false)

Check if there are available messages. If you define a level, only messages for that level will be considered.

### Flash::getMessages($level = false)

Get all available messages. If you define a level, only messages for that level will be returned.

### Flash::getLevels()

Get all available levels you can log to.

### Flash::[LEVEL]($message)

Store a message for the given leven.
