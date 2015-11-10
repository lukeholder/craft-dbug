<?php

namespace Craft;

require 'vendor/autoload.php';

class DbugPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Dbug');
    }

    public function getDescription()
    {
        return TemplateHelper::getRaw("Adds a <strong style='color:red'><code>dbug</code></strong> function to pretty dump variables in twig.");
    }

    public function getVersion()
    {
        return '2.5';
    }

    public function getSchemaVersion()
    {
        return '2.5';
    }

    public function getDeveloper()
    {
        return 'Luke Holder';
    }

    public function getDeveloperUrl()
    {
        return 'http://makewithmorph.com';
    }

    public function addTwigExtension()
    {
        require_once __DIR__."/extensions/DbugTwigExtension.php";
        return new DbugTwigExtension();
    }
}
