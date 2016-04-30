# Yii Phantomjs WebpageScreenshot

[![Latest Stable Version](https://poser.pugx.org/dotzero/yii-phantomjs-screenshot/version)](https://packagist.org/packages/dotzero/yii-phantomjs-screenshot)
[![License](https://poser.pugx.org/dotzero/yii-phantomjs-screenshot/license)](https://packagist.org/packages/dotzero/yii-phantomjs-screenshot)

The **Yii PhantomjsWebpageScreenshot** extension that allows to generate screenshots of web pages on the fly. It uses the headless webkit **PhantomJS** as a capture-engine.

**PhantomJS** is a headless **WebKit** with **JavaScript API**. It has fast and native support for various web standards: DOM handling, CSS selector, JSON, Canvas, and SVG.

## Requirements:

- [Yii Framework](https://github.com/yiisoft/yii) 1.1.14 or above
- [Composer](http://getcomposer.org/doc/)

## Install

### Via composer:

```bash
$ composer require dotzero/yii-phantomjs-screenshot
```

### Add vendor path to your configuration file, attach component and set properties.

```php
'aliases' => array(
    ...
    'vendor' => realpath(__DIR__ . '/../../vendor'),
),
'components' => array(
    ...
    'screenshot' => array(
        'class' => 'vendor.dotzero.yii-phantomjs-screenshot.EWebpageScreenshot',
        //'phantomjs' => '/bin/phantomjs',
        //'width' => 640,
        //'height' => 480,
    ),
),
```

## Usage:

```php
$screenshot = Yii::app()->screenshot;
$screenshot->width = 640;
$screenshot->height = 480;

$url = 'http://www.google.com';
$outfile = Yii::getPathOfAlias('application.runtime') . '/' . uniqid() . '.png';

$screenshot->capture($url, $outfile);
```

## License

Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
