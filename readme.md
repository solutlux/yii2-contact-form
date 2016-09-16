Emcms Module
============

Emcms Module is a simple client-side CMS module for Yii2. 

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require almeyda/yii2-main-module "dev-master"
```

or add

```
"almeyda/yii2-main-module": "dev-master"
```

to the required section of your `composer.json` file.

## Usage

Once the extension is installed, modify your application configuration to include:

```php
return [
	'components' => [
        ...
        'main' => [
            'class' => 'almeyda\yii2mainmodule\Module',
        ],
        ...
    ],	
];
```


## License

yii2-main-module is released under the Apache License 2.0. See the bundled [LICENSE.md](LICENSE.md) for details.

