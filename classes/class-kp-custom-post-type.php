<?php

    /**
     * A child class of the Csnqc_Post_Type.
     *
     * @package  csnqc-custom-post-types
     */

    /**
     * Extends Csnqc_Post_Type with functionality more specific to Wordpress 
     *  custom post types, such as content access control using an associated 
     *  taxonomy, modification of the "Les miens" text when a user is viewing 
     *  posts of a certain post type, support for excerpts, and individual
     *  label modifications.
     *  
     *  Like other files in the {@link csnqc-custom-post-types} package, it is intended for
     *  French language users and has not been properly localized.
     * 
     * @author   Michael Dean <mike@koumbit.org>
     * @version  1.0
     * @access   public
     * 
     * @see Csnqc_Post_Type
     * @see Csnqc_Media_Post_Type
     * @see Csnqc_Taxonomy
    */
    class KP_Custom_Post_Type extends KP_Post_Type {
        /**
         * @var mixed[] $args               Arguments for the register_post_type() Wordpress function.
         * @var String[] $capabilities      A list of unique strings thay are associated with Wordpress capabilities.
         *                                  This allows for the post type's content to be restricted by a taxonomy that
         *                                  can be assigned to a user {@link @Csnqc_Taxonomy}
         * @var Boolean $run_label_update   Indicates whether specific labels for the post type have been modified,
         *                                  and that the database should be updated to reflect the changes.
         *                                  {@link update_post_labels()}
         */
        protected $args, $capabilities, $run_label_update;
        
        /**
         * Set-up labels, define capability names and modify the "Les miens" text
         *  for the custom post type. Also adds hook actions for access control 
         *  (map_meta_cap), for registering the post type, and for updating post labels
         *  after the post type has been registered.
         * 
         * @param String $label     The main label used to reference the post type,
         *                          and shown on the user interface.
         * @param string $slug      The string used in the URL to reference the post type.
         *                          See Wordpress documentation for more in depth discussion.
         */
        public function __construct( $label, $slug = null ) {
            
            //save the label of the post type and create a machine name to reference it by
            parent::__construct( $label );
            
            //additional options for the content type - used for the Wordpress register_post_type()
            $this->args = array(
                'label'            => $this->label,
                'menu_position'     => 5,
                'public'            => true,
                'supports'          => array( 'title', 'editor', 'thumbnail', 'revisions', 'author' ),
                'has_archive'       => true,
                //'capability_type'   => $this->machine_name,
                //'capabilities'      => $this->create_capabilities(),
                'can_export'        => true,
                'yarpp_support'     => true,
                //'map_meta_cap'      => true
            );
            
            
            //register the post type
            add_action( 'init', array( $this, 'add_post_type' ) );
        }
        
        /**
         * Register the custom post type with Wordpress (saves to the database).
         * 
         * @return void
         */        
        public function add_post_type() {
            register_post_type( $this->machine_name, $this->args );
        }
    }