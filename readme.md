# Laravel Starter kit.
My personal laravel starter kit.


## Install

### Packagist
```
composer create-project --prefer-dist amir9480/laravel-kit my-project
```

### Git
```
git clone https://github.com/amir9480/laravel-kit.git my-projcet
cd my-project
copy .env.example .env
composer install
php artisan key:generate
```

Then run IDE Helper commands
```
php artisan ide-helper:generate
php artisan ide-helper:meta
```

(Optional)
```
php artisan ide-helper:models
```

## Recaptcha validation
To validate recaptcha add this to you'r validate function.
```php
    'g-recaptcha-response' => 'recaptcha'
```
Example:
```php
    $this->validate($request, [
        'g-recaptcha-response' => 'recaptcha'
    ]);
```

## Laravel web artisan
With using [Laravel terminal](https://github.com/recca0120/laravel-terminal) you can use artisan inside website. it's good idea to use laravel on shared hosts. just open *http://yoursite/admin/terminal* to use it. You can change who can access termianl with editing `access_terminal` gate in *AuthServiceProvider.php* or you can completly disable web terminal by changing `LARAVEL_TERMINAL` in *.env*  to false. If you want to migrate for first time just remove `'auth', 'can:access_terminal'` from *config/terminal.php* middlewares and after migration you can turn it back.

## Laravel translation manager
With using [Translation manager](https://github.com/barryvdh/laravel-translation-manager) you can allow translator access translations with a GUI to edit translations. open *http://yoursite/admin/translations* to use it. You can change who can access translation manager with editing `access_translation` gate in *AuthServiceProvider.php*.

## Packages:

* [barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors)
* [caouecs/laravel-lang](https://github.com/caouecs/Laravel-lang)
* [dimsav/laravel-translatable](https://github.com/dimsav/laravel-translatable)
* [doctrine/dbal](https://github.com/doctrine/dbal)
* [intervention/image](https://github.com/intervention/image)
* [intervention/imagecache](https://github.com/intervention/imagecache)
* [renatomarinho/laravel-page-speed](https://github.com/renatomarinho/laravel-page-speed)
* [spatie/laravel-collection-macros](https://github.com/spatie/laravel-collection-macros)
* [watson/rememberable](https://github.com/dwightwatson/rememberable)
* [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
* [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
* [laravel/dusk](https://github.com/laravel/dusk)
* [sven/artisan-view](https://github.com/svenluijten/artisan-view)
* [google/recaptcha](https://github.com/google/recaptcha)
* [themsaid/laravel-mail-preview](https://github.com/themsaid/laravel-mail-preview)
* [recca0120/laravel-terminal](https://github.com/recca0120/laravel-terminal)
* [barryvdh/laravel-translation-manager](https://github.com/barryvdh/laravel-translation-manager)

## License
[WTFPL](http://www.wtfpl.net/)
