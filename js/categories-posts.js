jQuery(document).ready(function($) {
    // hide posts
    $('#categories-posts .posts').hide();

    // toggle posts on click
    $('#categories-posts .toggle').click(function() {
        $link = $(this);
        $link.next().next().slideToggle('normal', function() {
            if ($(this).is(':visible'))
                $link.text('-');
            else
                $link.text('+');
        });
    });
});
