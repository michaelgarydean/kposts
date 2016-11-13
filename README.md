# kPosts
## Description
A Wordpress PHP framework used to quickly create custom post types.

## Example Usage
$recipes_post_type = new KP_Custom_Post_Type( "Recipes" );

$recipes_post_type->add_taxonomies( 
  $breakfast,
  $lunch,
  $dinner
);

$ingredients_metabox = new KP_Metabox( "Ingredients" );
$ingredients_metabox->add_field( "Quantity", 'number' );
$ingredients_metabox->add_field( "Ingredient", 'text' );

$recipes_post_type->add_metaboxes( $ingredients_metabox, "normal", "high" );
