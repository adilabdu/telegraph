![Pest Laravel Expectations](https://banners.beyondco.de/Laravel%20Telegraph.png?theme=light&packageManager=composer+require&packageName=defstudio%2Ftelegraph&pattern=architect&style=style_1&description=Telegram+bots+made+easy&md=1&showWatermark=1&fontSize=100px&images=phone-outgoing)

<a href="https://packagist.org/packages/defstudio/telegraph" target="_blank">
    <img style="display: inline-block; margin-top: 0.5em; margin-bottom: 0.5em" src="https://img.shields.io/packagist/v/defstudio/telegraph.svg?style=flat-square" alt="Latest Version on Packagist">
</a>

<a href="https://github.com/def-studio/telegraph/actions?query=workflow%3Arun-tests+branch%3Amain" target="_blank">
    <img style="display: inline-block; margin-top: 0.5em; margin-bottom: 0.5em" src="https://img.shields.io/github/workflow/status/def-studio/telegraph/run-tests?label=tests" alt="Tests">
</a>

<a href="https://github.com/def-studio/telegraph/actions?query=workflow%3Alint+branch%3Amain" target="_blank">
    <img style="display: inline-block; margin-top: 0.5em; margin-bottom: 0.5em" src="https://img.shields.io/github/workflow/status/def-studio/telegraph/lint?label=code%20style" alt="Code Style">
</a>

<a href="https://github.com/def-studio/telegraph/actions?query=workflow%3Aphpstan+branch%3Amain" target="_blank">
    <img style="display: inline-block; margin-top: 0.5em; margin-bottom: 0.5em" src="https://img.shields.io/github/workflow/status/def-studio/telegraph/phpstan?label=phpstan" alt="Static Analysis">
</a>

<a href="https://packagist.org/packages/defstudio/telegraph" target="_blank">
    <img style="display: inline-block; margin-top: 0.5em; margin-bottom: 0.5em" src="https://img.shields.io/packagist/dt/defstudio/telegraph.svg?style=flat-square" alt="Total Downloads">
</a>

---


**Telegraph** is a Laravel package for fluently interaction with Telegram Bots

```php
Telegraph::message('hello world')
    ->keyboard(Keyboard::make()->buttons([
            Button::make('Delete')->action('delete')->param('id', '42'),
            Button::make('open')->url('https://test.it'),
    ]))->send();
```

## Installation

You can install the package via composer:

```bash
composer require defstudio/telegraph
```

Publish and launch required migrations:

```bash
php artisan vendor:publish --tag="telegraph-migrations"
```

```bash
php artisan migrate
```

Optionally, you can publish the config file with:
```bash
php artisan vendor:publish --tag="telegraph-config"
```

## Usage

After a new bot is created and added to a chat/group/channel (as described [in our documentation](https://def-studio.github.io/telegraph/quickstart/new-bot)),
the `Telegraph` facade can be used to easily send messages and interact with it:

```php
Telegraph::message('this is great')->send();
```

An extensive documentation is available at

https://def-studio.github.io/telegraph

## Forked Project

This forked project intends to implement the `Inline Mode` API referenced [here on the Telegram Bot API documentation](https://core.telegram.org/bots/api#inline-mode). 

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Fabio Ivona](https://github.com/def-studio)
- [Andrea Marco Sartori](https://github.com/cerbero90) for his cool ideas
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
