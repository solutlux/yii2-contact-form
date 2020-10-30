Yii2 contact form 
============

Contact form is a simple module for Yii2. 

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require solutlux/yii2-contact-form "*"
```

or add

```
"solutlux/yii2-contact-form": "*"
```

to the required section of your `composer.json` file.

## Usage

Once the extension is installed, modify your application configuration to include:

```php
return [
	'modules' => [
        ...
        'main' => [
            'class' => 'solutlux\yii2contactform\Module',
        ],
        ...
    ],	
];
```


## License

yii2-contact-form is released under the Apache License 2.0. See the bundled [LICENSE.md](LICENSE.md) for details.

