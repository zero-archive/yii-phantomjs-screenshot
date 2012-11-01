<?php
/**
 * WebpageScreenshot class file.
 *
 * @package YiiPhantomjsWebpageScreenshot
 * @author dZ <mail@dotzero.ru>
 * @link http://www.dotzero.ru
 * @link https://github.com/dotzero/YiiPhantomjsWebpageScreenshot
 * @license MIT
 * @version 1.0 (1-nov-2012)
 */

/**
 * The Yii PhantomjsWebpageScreenshot extension that allows to generate screenshots of web pages on the fly.
 * It uses the headless webkit PhantomJS as a capture-engine.
 *
 * Requirements:
 * Yii Framework 1.1.0 or later
 *
 * Installation:
 * - Extract the release folder under 'protected/extensions'
 * - Download and install PhantomJS (http://phantomjs.org/) headless WebKit with JavaScript API
 * - Add the following to your config file 'components' section:
 *
 *     'screenshot' => array(
 *         'class' => 'application.extensions.phantomjs-webpage-screenshot.WebpageScreenshot',
 *         #'phantomjs' => '/bin/phantomjs',
 *         #'width' => 640,
 *         #'height' => 480,
 *     ),
 *
 * Usage:
 * $screenshot = Yii::app()->screenshot;
 * $screenshot->width = 640;
 * $screenshot->height = 480;
 *
 * $url = 'http://www.google.com';
 * $outfile = Yii::getPathOfAlias('application.runtime') . '/' . uniqid() . '.png';
 *
 * $screenshot->capture($url, $outfile);
 */
class WebpageScreenshot extends CComponent
{
    /**
     * Holds the path to the PhantomJS executable
     */
    private $_phantomjs = '/usr/local/bin/phantomjs';

    /**
     * Holds the width of the viewport for the layout process
     */
    private $_width = 1024;

    /**
     * Holds the height of the viewport for the layout process
     */
    private $_height = 768;

    /**
     * Extension initialization
     */
    public function init()
    {
        // pass
    }

    /**
     * Set the path to the PhantomJS executable
     *
     * @param string $value
     */
    public function setPhantomjs($value)
    {
        $this->_phantomjs = $value;
    }

    /**
     * Set the width of the viewport for the layout process
     *
     * @param integer $value
     */
    public function setWidth($value)
    {
        $this->_width = intval($value);
    }

    /**
     * Set the height of the viewport for the layout process
     *
     * @param integer $value
     */
    public function setHeight($value)
    {
        $this->_height = intval($value);
    }

    /**
     * Captures the entire screen and saves it as a file
     *
     * @param string $url URL of a Web Page
     * @param string $outfile the output format is automatically set based on the file extension.
     * Supported formats include: PNG | GIF | JPG |PDF
     * @return bool
     */
    public function capture($url, $outfile)
    {
        $script = dirname(__FILE__) . '/phantomjs/screenshot.js';

        $args = array(
            $url,
            $outfile,
            $this->_width,
            $this->_height
        );

        $this->_execute($script, $args);

        return file_exists($outfile);
    }

    /**
     * Executes PhantomJS using the provided arguments
     *
     * @param string $script path to JavaScript file
     * @param string $argsString provided arguments
     * @return string
     * @throws WebpageScreenshotException
     */
    private function _execute($script, $argsString)
    {
        if(!file_exists($this->_phantomjs) OR is_dir($this->_phantomjs))
        {
            throw new WebpageScreenshotException(WebpageScreenshot::t('The PhantomJS executable "{path}" was not found.',
                array('{path}' => $this->_phantomjs)
            ));
        }

        $cmd = $this->_phantomjs . ' ' . $script . ' ' . escapeshellcmd(implode(' ', $argsString));

        return shell_exec($cmd);
    }

    /**
     * Translates a message to the specified language.
     *
     * @param string $message the original message
     * @param array $params parameters to be applied to the message using <code>strtr</code>.
     * @param string $source which message source application component to use.
     * @return string the translated message
     */
    public static function t($message, $params = array(), $source = 'webpagescreenshot')
    {
        return Yii::t('WebpageScreenshot.'.$source, $message, $params);
    }
}

/**
 * WebpageScreenshotException represents a generic exception for WebpageScreenshot class.
 *
 * @package YiiPhantomjsWebpageScreenshot
 * @author dZ <mail@dotzero.ru>
 * @link http://www.dotzero.ru
 * @link https://github.com/dotzero/YiiPhantomjsWebpageScreenshot
 * @license MIT
 * @version 1.0 (1-nov-2012)
 */
class WebpageScreenshotException extends Exception
{
    public function __construct($msg, $code = 0)
    {
        parent::__construct($msg, $code = 0);
    }
}
