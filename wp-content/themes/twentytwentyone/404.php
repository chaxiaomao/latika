<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

    <div>

        <div style="width: 100%;text-align: center;">
            <img style="width: 40.4%" src="<?php echo esc_url(get_template_directory_uri()) . '/assets/img/404.png' ?>" alt="404">
        </div>



        <section style="width: 20%;margin: 0 auto;margin-top: 52px">
            <p>Oooops! No result here.</p>

            <form action="<?php echo get_site_url() ?>" method="get" autocomplete="off">
                <input type="text" value="<?php echo get_search_query() ?>" name="s" placeholder="Find your article"/>
                <label for="favorite" class="checkbox">
                    <input type="checkbox" id="favorite" name="favorite"/>
                    Google 搜索
                </label>
                <!--            <button class="button-83" role="button" style="width: 100%">Search!</button>-->
            </form>
        </section>


    </div>

<?php
get_footer();
