<?php


namespace CORE\Routes;

class Parse {


    public static function regex_path_par_url($path){
        $teste = \preg_replace('#:([a-z]+)(?=/|$)#','(\w+)',$path);
        $regex= '/^' . str_replace('/', '\/', $teste) . '$/';

        return $regex;
    }


    public static function checkUrlAgainstPattern($url, $pattern) {
        // parse $pattern into a regex, and build a list of variable names
        $vars = array();
        $regex = preg_replace_callback(
            '#/:([a-z]+)(?=/|$)#',
            function($x) use (&$vars) {
           
                $vars[] = $x[1];
                return '/([^/]+)';
            },
            $pattern
        );
    
      
    
        // check $url against the regex, and populate variables if it matches
        $vals = array();
        if (preg_match("#^{$regex}$#", $url, $x)) {
     
            foreach ($vars as $id => $var) {
                $vals[$var] = $x[$id + 1];
            }
            return $vals;
        } else {
            return false;
        }
    }
    
}