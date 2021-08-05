<?php namespace Watchlearn\Contact;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'WatchLearn\Contact\Components\ContactForm'=>'contactform',
        ];
    }

    public function registerSettings()
    {
    }
}
