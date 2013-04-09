<?php

namespace Craft;

class DbugTwigExtension extends \Twig_Extension
{
    protected $env;

    public function getName()
    {
        return 'dbug';
    }

    public function getFilters()
    {
        return array(
            'dbug'  => new \Twig_Filter_Method($this, 'dbug', array('is_safe' => array('html'))),
            'dbugex'  => new \Twig_Filter_Method($this, 'dbugex', array('is_safe' => array('html')))
        );
    }
    public function getFunctions()
    {
        return array(
            'dbug'  => new \Twig_Function_Method($this, 'dbug', array('is_safe' => array('html'))),
            'dbugex'  => new \Twig_Function_Method($this, 'dbugex', array('is_safe' => array('html')))
        );
    }


    public function dbug($var, $name = "DBUG", $isCollapsed=true, $forceType="")
    {
        $main_array = array();
        $html = "";
        if (is_null($var)) {
            $main_array["Null"] = Null;
            $html = $this->pretty($main_array,$forceType,$isCollapsed,$name);
        } elseif (is_numeric($var)){
            $main_array["Number"] = $var;
            $html = $this->pretty($main_array,$forceType,$isCollapsed,$name);
        } elseif (is_string($var)){
            $main_array["String"] = $var;
            $html = $this->pretty($main_array,$forceType,$isCollapsed,$name);
        } elseif (is_array($var)) {
            $main_array["Data"] = $var;
            $html = $this->pretty($main_array,$forceType,$isCollapsed,$name);
        } elseif (is_object($var)) {

            if (method_exists($var, 'getHelpText')) {
                $main_array["Help Info"] = $var->getHelpText();
            }

            $attributes = array();

            if (method_exists($var, 'getAttributes')) {
                $attributes = $var->getAttributes();

            }

            $reflector = new \ReflectionClass($var);
            foreach ($reflector->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
                $attributes[$property->name] = $property->getValue($var);
            }

            ksort($attributes);
            $main_array["Attrubutes"] = $attributes;

            $methods = array();

            foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                if ('_' !== substr($method->name, 0, 1)) {
                    $methods[] = "\n    ".$method->name;
                }
            }

            if ($methods) {
                sort($methods);
                $main_array["Methods"] = $methods;
            }

            $html .= $this->pretty($main_array,$forceType,$isCollapsed,$name);

        }else {
            $html .= $this->pretty($var,$forceType,$isCollapsed,$name);
        }

        return $html;

    }

    public function pretty($var, $forceType="", $bCollapsed=true, $var_name='' )
    {
        $html = "";

        ob_start();
            new \Ospinto\Dbug($var, $forceType, $bCollapsed, $var_name);
            $html .= ob_get_contents();  
        ob_end_clean();

        return $html;
    }
}
