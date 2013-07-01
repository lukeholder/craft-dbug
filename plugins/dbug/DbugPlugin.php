<?php

namespace Craft;

require 'vendor/autoload.php';

class DbugPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Dbug');
    }

    public function getVersion()
    {
        return '1.2';
    }

    public function getDeveloper()
    {
        return 'Luke Holder';
    }

    public function getDeveloperUrl()
    {
        return 'http://logicandpixels.com.au';
    }

    public function hookAddTwigExtension()
    {
        Craft::import('plugins.dbug.twigextensions.dbugTwigExtension');

        return new dbugTwigExtension();
    }
}
