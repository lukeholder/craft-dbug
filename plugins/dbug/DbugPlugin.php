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
        return '2.0';
    }

    public function getDeveloper()
    {
        return 'Luke Holder';
    }

    public function getDeveloperUrl()
    {
        return 'http://holpac.com';
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.dbug.twigextensions.DbugTwigExtension');

        return new DbugTwigExtension();
    }
}
