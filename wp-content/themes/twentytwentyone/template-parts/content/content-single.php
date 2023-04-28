<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// $thumbnail_image = get_posts(array('p' => get_post_thumbnail_id($post->ID), 'post_type' => 'attachment'));
// if ($thumbnail_image && isset($thumbnail_image[0])) {
//     $img_description = $thumbnail_image[0]->post_content;
//     $img_caption = $thumbnail_image[0]->post_excerpt;
//     $img_title = $thumbnail_image[0]->post_title;
//     $img_alt = get_post_meta(get_post_thumbnail_id($post->ID) , '_wp_attachment_image_alt', true);
//     print_r($img_alt);
// }

$categories = get_the_category();
?>

<?php get_home_nav(null, ['cate' => $categories[0]->term_id]); ?>

<div class="flex_container">

    <div class="col_3of4">

        <div class="card">
            <ul class="breadcrumb">
                <?php foreach ($categories as $item): ?>
                    <li><a href="<?php echo get_category_link($item->term_id) ?>"><?php echo $item->name ?></a></li>
                <?php endforeach; ?>
                <li><a href="javascript:;"><?php the_title() ?></a></li>
            </ul>
        </div>

        <article id="post-<?php the_ID(); ?>" class="card">
            <div class="post_details">
                <div>
                    <?php
                    $article_post = get_post_custom_values('article_post', get_the_ID())[0];
                    if (!empty($article_post)) {
                        echo '<img class="post_img" alt="Post_Post" src="' . $article_post . '">';
                    }
                    ?>
                </div>

                <div style="text-align: right;font-style: italic;font-size: .8rem">
                    <?php
                    $article_post_source = get_post_custom_values('article_post_source', get_the_ID())[0];

                    if (!empty($article_post_source)) {
                        echo '<span style="font-style: italic">' . $article_post_source . '</span><br/>';
                    }
                    ?>
                    <span style="font-style: italic">Post by <?php echo get_the_author() . ' on ' . get_the_date('M d,Y') ?></span>
                </div>
                <div class="post_content">
                    <h2 class="post_content_title"><?php echo the_title() ?></h2>

                    <?php
                    // $snippet_filename = get_post_custom_values('snippet_filename', get_the_ID())[0];
                    // $snippet_style = get_post_custom_values('snippet_style', get_the_ID())[0];
                    // $url = get_theme_file_uri('/assets/snippets/' . $snippet_filename);
                    // ?>
                    <?php //if (!empty($snippet_filename)): ?>
                    <!--    <div class="iframe-box" style="padding-top: 1rem">-->
                    <!--        <iframe id="snippet_iframe"-->
                    <!--                style="--><?php //echo !empty($snippet_style) ? $snippet_style : 'width:100%;height:100%;' ?><!--"-->
                    <!--                src="--><?php //echo $url ?><!--"-->
                    <!--                frameborder="0">-->
                    <!---->
                    <!--        </iframe>-->
                    <!--    </div>-->
                    <?php //endif; ?>
                    <?php //the_content() ?>

                    <?php
                    $snippets = get_post_custom_values('snippets', get_the_ID());
                    $content = get_the_content();
                    if (!empty($snippets)) {
                        foreach ($snippets as $i => $snippet) {
                            $i++;
                            $content = str_replace("{{snippet{$i}}}", $snippet, $content);
                        }
                    }
                    $content = apply_filters( 'the_content', $content );
                    $content = str_replace( ']]>', ']]&gt;', $content );
                    echo $content;
                    ?>

                </div>
            </div>
        </article>

        <?php //$article_paper_tips = get_post_custom_values('article_paper_tips', get_the_ID())[0]; ?>
        <!---->
        <!--<div class="paper">-->
        <!--    <div class="flex_container nail_line">-->
        <!--        <div class="matter">-->
        <!--            <p>--><?php //echo $article_paper_tips ?><!--</p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->


    </div>

    <div class="col_1of4">

        <?php echo get_right_panel(); ?>


    </div>

</div>
<!--</div>-->

<?php
get_footer()
?>

