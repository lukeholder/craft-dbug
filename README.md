# dbug Plugin for Craft CMS

This plugin adds a helpful `dbug` method to your Craft templates. This will help you
see in the dark - figure out what kind of variables you are dealing with, and what methods
they implement.

## Installation

1. Upload the contents of `plugins/dbug/` directory to `craft/plugins/dbug/` on your server.
2. Enable the plugin under *Craft Admin > Settings > Plugins*

## Usage

You can use dbug either as a function or filter:

    {{ craft.request | dbug }}
    {{ dbug(craft.request) }}

Click the green boxes to see output!

Aha! We can see this variable has some useful methods on it. Let's dig deeper:

    {{ craft.request.getSegments | dbug }}

Now we're getting somewhere! No more digging around in the documentation trying to figure out
what's available to you.

The output is default colapsed as to not mess up your design. Cick the Green boxes to expand.

You can also name your dbug output so its easier to find on the page. Just add a string
to give your output a name:

{{ craft.request.getSegments | dbug("request segments") }}

The above is useful when the debug data is not clear or you have lots of dbugs on 
a page.

## Developers

Just like Adrian Macneil's Inspector we have added support for debug to your plugins!
Simply add a `getHelpText` method to your models, and it will be displayed when
people dbug your object. For example:

    class PizzaModel extends BaseModel
    {
        public function getHelpText()
        {
            return "This variable represents a pizza.";
        }
    }

When people debug your object, they will now see the help text in the expandable tree.
Under "Help Text"

Please submit issues and feature requests through the github issues.


## Thanks

Adrian Macniel
