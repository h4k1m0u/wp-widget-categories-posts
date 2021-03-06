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
        wp_enqueue_style('categories-posts.css', plugins_url('css/categories-posts.css', __FILE__));
        wp_enqueue_script('categories-posts.js', plugins_url('js/categories-posts.js', __FILE__), array('jquery'));

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
        <h1 class="widget-title">Categories</h1>
        <nav>
            <ul class="categories">
                <?php
                    // get categories
                    $categories = get_categories(array(
                        'orderby'   => 'count',
                        'order'     => 'DESC'
                    ));

                    // loop over categories
                    foreach ($categories as $category) {
                    ?>
                        <li class="category">
                            <a href="javascript:void(0)" title="Expand/Retract" class="toggle">+</a>
                            <a href="<?php echo esc_url(get_category_link($category->cat_ID)); ?>" title="<?php echo $category->name; ?>">
                                <?php echo $category->name; ?>
                                <span class="posts-count">
                                    (<?php echo $category->count; ?>)
                                </span>
                            </a>
                            <ul class="posts">
                                <?php
                                    // get posts inside category
                                    $posts = array();
                                    if ($category->count > 0)
                                        $posts = get_posts(array(
                                            'category'          => $category->cat_ID,
                                            'posts_per_page'    => 3
                                        ));

                                    // loop over posts
                                    foreach ($posts as $post) {
                                    ?>
                                        <li class="post">
                                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" title="<?php echo $post->post_title; ?>">
                                                <?php echo $post->post_title; ?>
                                            </a>
                                        </li>
                                    <?php
                                    }

                                    // link to remaining hidden posts
                                    if ($category->count > 3) {
                                    ?>
                                        <li class="post">
                                            <a href="<?php echo esc_url(get_category_link($category->cat_ID)); ?>" title="<?php echo $category->name; ?>">
                                                ...
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
        </nav>
    </aside>
    <?php
    }
}

// register the widget
add_action('widgets_init', function() {
    register_widget('Categories_Posts_Map_Widget');
});
