<?php

class Plugin_Loader{
    public static $instance;
    
    static $patterns = array(
        '%2$s/%1$s/%1$s.php',
        '%2$s/%1$s/plugin.php',
        '%2$s/%1$s.php'
    );
    
    function resolve_plugin($name){
        $dirs = array(
            get_stylesheet_directory() . '/plugins',
            get_template_directory() . '/plugins'
        );
        
        foreach($dirs as $dir){
            foreach(Plugin_Loader::$patterns as $patt){
                $path = sprintf($patt, $name, $dir);
                if(file_exists($path)){
                    return $path;
                }
            }
        }
        
        throw new Exception(sprintf('The requested plugin, %1$s, could not be loaded', $name));
    }
    
}
Plugin_Loader::$instance = new Plugin_Loader();
function load_plugin($name){

    $file = Plugin_Loader::$instance->resolve_plugin($name);
    if(false !== $file){
        require_once $file;
    }
}

