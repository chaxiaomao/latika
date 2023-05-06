<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
if (have_posts()) {

    echo '<section>
    
        <form style="float: right" action="' . get_site_url() . '" method="get" autocomplete="off">
            <input type="text" name="s" value="' . get_search_query() . '" placeholder="Find your article"/>
        </form>
    </section><div style="clear: both"></div>';

    // Start the Loop.
    while (have_posts()) {
        the_post();

        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part('template-parts/content/content-excerpt', get_post_format());
    } // End the loop.

    // Previous/next page navigation.
    twenty_twenty_one_the_posts_navigation();

    // If no content, include the "No posts found" template.
} else {
    get_template_part('template-parts/content/content-none');
}

get_footer();
