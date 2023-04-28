<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
// if ( has_post_thumbnail() ) :
//     the_post_thumbnail();
//     echo '<p>' . get_post(get_post_thumbnail_id())->post_title . '</p>';
//     echo '<p>' . get_post(get_post_thumbnail_id())->post_excerpt . '</p>';
//     echo '<p>' . get_post(get_post_thumbnail_id())->post_content . '</p>';
// endif;

?>

<article id="post-<?php the_ID(); ?>" class="card post_list_item">

    <div class="flex_container">
        <div class="post_list_icon">
            <?php
            $img_title = '';
            $thumbnail_image = get_posts(array('p' => get_post_thumbnail_id($post->ID), 'post_type' => 'attachment'));
            if ($thumbnail_image && isset($thumbnail_image[0])) {
                $img_title = $thumbnail_image[0]->post_title;
                $img_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
            }
            ?>
            <img style="<?php echo !empty($img_alt) ? 'width: ' . $img_alt : '' ?>" src="<?php echo get_the_post_thumbnail_url(); ?>"
                 alt="<?php echo $img_title ?>"/>
        </div>
        <div class="post_list_details" style="width: 100%">
            <div class="post_list_detail_box">
                <div class="post_list_detail_title">
                    <a href="<?php echo get_permalink() ?>"><?php the_title() ?></a>
                </div>
                <div class="post_list_detail_date">
                    <?php
                    $date = get_the_date('m.d Y');
                    if ($date[0] == '0') {
                        echo substr($date, 1);
                    } else {
                        echo $date;
                    }
                    ?>
                </div>
            </div>
            <div class="description">
                <?php
                add_filter('excerpt_length', function ($length) {
                    return 345;
                });
                // the_excerpt();
                echo apply_filters( 'the_excerpt', get_the_excerpt() );
                ?>
            </div>

        </div>
    </div>
</article>