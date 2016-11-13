<?php

/**
 * Load all the directories that contain classes
 */

//include the interface
require_once( 'classes/interface-kp.php' );

//load classes when a class is referenced
spl_autoload_register( 'kp_autoloader' );

//autoload classes based on class name and related file name
function kp_autoloader( $class ) {
    
    //check if class name requested contains the KP prefix
    if ( false !== strpos( $class, 'KP_' ) ) {
        
        //get path of class directory
        $classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR;
        $class_file = strtolower( 'class-' . str_replace( '_', '-', $class ) . '.php' );
        
        //require the class file requested
        require_once $classes_dir . $class_file;
    }
}