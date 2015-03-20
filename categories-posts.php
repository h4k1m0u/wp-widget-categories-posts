<?php
/*
Plugin Name: Categories posts
Plugin URI: http://plugin.url
Description: A plugin that gets categories and their posts and show them in a tree view. 
Version: 1.0
Author: Hakim Benoudjit
Author URI: http://author.url
*/

class Categories_Posts_Map_Widget extends WP_Widget {
    public function __construct() {
        // init widget
        parent::WP_Widget(
            'categories-posts',
            'Categories Posts',
            array(
                'classname' => 'categories-posts',
                'description' => 'Categories and their posts shown in a tree view'
            )
        );
    }
    
    public function widget($args, $instance) {
    ?>
    <aside id="categories-posts" class="widget widget_categories_posts">
        <h1 class="widget-title">Categories Posts</h1>
        <div>
            <ul class="categories">
                <?php
                    // get categories
                    $categories = get_categories(array(
                        'hide_empty' => false
                    ));

                    // loop over categories
                    foreach ($categories as $category) {
                    ?>
                        <li class="category">
                            <a href="<?php echo esc_url(get_category_link($category->cat_ID)); ?>" title="<?php echo $category->name; ?>">
                                <?php echo $category->name; ?> (<?php echo $category->count; ?>)
                            </a>
                            <ul>
                                <?php
                                    // get posts inside category
                                    $posts = get_posts(array(
                                        'category' => $category->cat_ID
                                    ));

                                    // loop over posts
                                    foreach ($posts as $post) {
                                    ?>
                                        <li class="post">
                                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo $post->post_name; ?>">
                                                <?php echo $post->post_name; ?>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                ?>
                            </ul>
                        </li>
                    <?php
                    }
                ?>
            </ul>
        </div>
    </aside>
    <?php
    }
}

// register the widget
add_action('widgets_init', function() {
    register_widget('Categories_Posts_Map_Widget');
});
