jQuery(document).ready(function($) {
    // hide posts
    $('#categories-posts .posts').hide();

    // toggle posts on click
    $('#categories-posts .toggle').click(function() {
        $link = $(this);
        $posts = $link.next().next();

        // slide only if there are posts
        if ($.trim($posts.html()) != '')
            $posts.slideToggle('normal', function() {
                if ($(this).is(':visible'))
                    $link.text('-');
                else
                    $link.text('+');
            });
        else
            return false;
    });
});
