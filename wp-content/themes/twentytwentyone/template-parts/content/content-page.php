<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$about = get_page_by_path('about');
$matter = get_page_by_path('matter');
$privacy_policy = get_page_by_path('privacy-policy');
?>
<?php get_home_nav(null, ['cate' => -1]); ?>

<div class="flex_container">
    <div class="col_3of4">
        <article id="post-<?php the_ID(); ?>" class="card">
            <div class="post_details">
                <div class="post_content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
        <?php //if($post->post_name == 'matter'): ?>
        <!---->
        <!--    <div class="paper">-->
        <!--        <div class="flex_container nail_line">-->
        <!--            <div class="matter">-->
        <!--                --><?php //the_content(); ?>
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <?php //else: ?>
        <!--<article id="post---><?php //the_ID(); ?><!--" class="card">-->
        <!--    <div class="post_details">-->
        <!--        <div class="post_content">-->
        <!--            --><?php //the_content(); ?>
        <!--        </div>-->
        <!--    </div>-->
        <!--</article>-->
        <?php //endif; ?>
    </div>

    <div class="col_1of4">
       <div class="panel_right">
           <div class="post_list_container">
               <div class="card post_list_item">
                   <div class="post_list_details">
                       <a href="/matter" class="<?php echo 'matter' == $post->post_name ? 'active' : '' ?>">Matter</a>
                   </div>
               </div>
               <div class="card post_list_item">
                   <div class="post_list_details">
                       <a href="/about" class="<?php echo 'about' == $post->post_name ? 'active' : '' ?>">有关我</a>
                   </div>
               </div>
               <div class="card post_list_item">
                   <div class="post_list_details">
                       <a href="/privacy-policy" class="<?php echo 'privacy-policy' == $post->post_name ? 'active' : '' ?>">隐私政策</a>
                   </div>
               </div>
           </div>
       </div>
    </div>


</div>

