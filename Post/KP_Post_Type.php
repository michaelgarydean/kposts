<?php

    namespace KP\Post;
    use KP\KP_Entity;
    
    abstract class KP_Post_Type extends KP_Entity {
        protected $taxonomies;
        
        protected $metaboxes;
        protected $text_editors;
        
        private $post_args;
        private $labels;
        
        public function __construct( $label )  {
            //save the label of the post type and create a machine name to reference it by
            parent::__construct( $label );
        }
    }