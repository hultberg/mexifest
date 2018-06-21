# mexifest

A simple asset manager that parses manifest files for php.

Requires php 7.1.

## Install

```
$ composer require hultberg/mexifest
```

## Usage

**manifest.json**
```json
{
    "app.js": "js/app.js",
    "app.css": "css/app.css"
}
```

**app.php**
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Hultberg\Mexifest\AssetManager;
use Hultberg\Mexifest\WebpackManifestParser;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem;

$fs = new Filesystem(new LocalAdapter(__DIR__));
$am = new AssetManager((new WebpackManifestParser($fs, 'manifest.json'))->parse());

/*
  Output: [
    ['app.js', 'js/app.js', 'js'],
  ]
 */
var_dump($am->findByName('app.js'));

/*
  Output: [
    ['app.css', 'css/app.css'],
  ]
 */
var_dump($am->findByExtension('css'));
```

## License

MIT, see LICENSE.md provided in repo.
