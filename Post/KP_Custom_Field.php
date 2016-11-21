<?php

    /**
     * Custom fields created for metaboxes.
     *
     * @package  kp-custom-post-types
     */

    /**
     * Provides functionality to manage Wordpress custom fields and associated 
     * data, such as interface labels.
     * 
     * Custom fields are intended for use within Wordpress metaboxes (using the 
     * KP_Metabox object), typically present inside custom post types.
     * 
     * @author   Michael Dean <mike@koumbit.org>
     * @version  1.0
     * @access   public
     * 
     * @see KP_Custom_Post_Type
     * @see KP_Media_Post_Type
     * @see KP_Metabox
     * 
    */
    
    namespace KP\Post;
    
    use KP\Post;
    use KP\KP_Entity;
    
    class KP_Custom_Field extends KP_Entity {
        /**
         * @var KP_Metabox $parent_metabox      The metabox object this field belongs to.
         * @var String $caption                 Some text to display in a <span> element under the field.
         */
        private $parent_metabox, $caption;
        
        /**
         * @var String $input_type              The type of HTML element to display for this field. 
         *                                      Possible values include checkbox, text, date, radio, textarea, number, email.
         * @var String[] $input_values          The options to display for an element with multiple options (for example, with checkboxes)
         */
        public $input_type, $input_values;
        
        /**
         * @var Boolean $required               Whether or not this is a required field (used for form validation).
         */
        public $required;
        
        /**
         * Create a custom field to be used within a {@link Csnqc_Metabox metabox}.
         * 
         * The constructor links a Csnqc_Metabox object to the custom field, creating
         *  parent-child relationship. The input type, as well as any neccessary values,
         *  are also stored, later used to display the custom field in the Wordpress interface.
         *  Finally, the standard naming functions are called by calling the object's parent
         *  constructor.
         * 
         * @param String $label                 The title of the taxonomy used in the user interface.
         * @param Csnqc_Metabox $parent_entity  The metabox object this field belongs to.
         * @param String $input_type            The type of HTML element to display for this field. 
         *                                      Possible values include checkbox, text, date, radio, textarea, number, email.
         * @param String[] $input_values        The options to display for an element with multiple options (for example, with checkboxes)
         */
        public function __construct( $label, $parent_entity, $input_type, $input_values ) {
            
            //the parent is used primarily for naming purposes - sets the prefix of the object
            $this->parent_metabox = $parent_entity;
            $this->input_type = strtolower($input_type);
            $this->input_values = $input_values;
            $this->set_caption("");
            
            //prefix with the parents name
            $this->prefix = $parent_entity->machine_name;
            
            //save the label of the post type and create a machine name to reference it by
            parent::__construct( $label, $parent_entity );
        }
        
        /**
         * Sets the text description that is displayed just underneath the custom field.
         * 
         * @param String $caption   Text to display under the custom field.
         */
        public function set_caption( $caption ) {
            $this->caption = $caption;
        }
    }