# Yii Phantomjs WebpageScreenshot

The **Yii PhantomjsWebpageScreenshot** extension that allows to generate screenshots of web pages on the fly. It uses the headless webkit **PhantomJS** as a capture-engine.

**PhantomJS** is a headless **WebKit** with **JavaScript API**. It has fast and native support for various web standards: DOM handling, CSS selector, JSON, Canvas, and SVG.

## Requirements:

Yii Framework 1.1.0 or later

## Installation:

- Extract the release folder under `protected/extensions`
- Download and install [PhantomJS](http://phantomjs.org/) headless **WebKit** with **JavaScript API**
- Add the following to your **config file** `components` section:

      'screenshot' => array(
          'class' => 'application.extensions.phantomjs-webpage-screenshot.WebpageScreenshot',
          //'phantomjs' => '/bin/phantomjs',
          //'width' => 640,
          //'height' => 480,
      ),

## Usage:

    $screenshot = Yii::app()->screenshot;
    $screenshot->width = 640;
    $screenshot->height = 480;

    $url = 'http://www.google.com';
    $outfile = Yii::getPathOfAlias('application.runtime') . '/' . uniqid() . '.png';

    $screenshot->capture($url, $outfile);
