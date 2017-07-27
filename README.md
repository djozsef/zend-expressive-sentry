# Zend Expressive Sentry

This is a quick addon for Zend Expressive to allow it to report it's errors to Sentry

## Configuration instructions

Add the class `\Stickee\Sentry\ConfigProvider` to your main config aggregation

For example:-


```php
<?php

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$cacheConfig = [
    'config_cache_path' => 'data/config-cache.php',
];

$aggregator = new ConfigAggregator(
    [
        \Stickee\Sentry\ConfigProvider::class,

        // Include cache configuration
        new ArrayProvider($cacheConfig),

        // Default App module config
        \App\ConfigProvider::class,

        // Load application config in a pre-defined order in such a way that local settings
        // overwrite global settings. (Loaded as first to last):
        //   - `global.php`
        //   - `*.global.php`
        //   - `local.php`
        //   - `*.local.php`
        new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),

        // Load development config if it exists
        new PhpFileProvider('config/development.config.php'),
    ], $cacheConfig['config_cache_path']
);

return $aggregator->getMergedConfig();
```

This will then automatically add Sentry as an error listener.

You can configure the DSN by defining it in your config files - we suggest copying `config/sentry.global.php.dist` to
your app's `config/autoload` and renaming it to `sentry.global.php` - add in your DSN (or set the environment variable)
and you're all done!

