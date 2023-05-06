<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
get_header(); ?>

<?php get_home_nav(null, ['cate' => 0]); ?>

    <div class="flex_container">

        <!-- LEFT  -->
        <div class="col_1of5">
            <div class="panel_left">
                <!-- 随机安利 -->
                <div class="post_list_container">
                    <div class="card post_list_item" style="border-radius: 5px 5px 0 0;">
                        <div style="border-radius: 5px 5px 0 0;width: 100%;padding: 0;height: 40px;text-align: center;line-height: 40px;color: #999">
                            随机安利
                        </div>
                    </div>
                    <div class="panel_left_posts random_anli">
                        <div class="card post_list_item post_list_details">
                            <a href="https://www.shejidaren.com/xin-3d-ui-style.html" target="_blank">3D新拟物风格的兴起</a>
                        </div>
                        <div class="card post_list_item post_list_details">
                            <a href="https://www.shejidaren.com/xin-ni-wuhua-sheji.html" target="_blank">新拟物化设计，是2020年最值得期待的设计手法？</a>
                        </div>
                        <div class="card post_list_item post_list_details">
                            <a href="https://www.shejidaren.com/%e5%bd%93%e6%89%81%e5%b9%b3%e5%8c%96ui%e8%bd%ac%e6%8b%9f%e7%89%a9%e5%8c%96%e8%ae%be%e8%ae%a1%e5%90%8e.html"
                               target="_blank">当扁平化UI转拟物化设计后</a>
                        </div>
                        <div class="card post_list_item post_list_details">
                            <a href="https://www.shejidaren.com/ps-che-zi.html" target="_blank">PS 绘制拟物化 UI 作品：厕纸</a>
                        </div>
                        <div class="card post_list_item post_list_details">
                            <a href="https://www.shejidaren.com/40-ios-icons-design.html" target="_blank">40个逼真拟物化 iOS
                                图标设计作品</a>
                        </div>
                        <div class="card post_list_item post_list_details">
                            <a href="https://www.shejidaren.com/skeuomorphism-ipad-ui-designs.html" target="_blank">优秀的iPad
                                skeuomorphism UI界面设计欣赏</a>
                        </div>
                    </div>
                </div><!-- 随机安利 -->
                <!-- 友情链接 -->
                <div class="post_list_container">
                    <div class="card post_list_item" style="border-radius: 5px 5px 0 0;">
                        <div style="border-radius: 5px 5px 0 0;width: 100%;padding: 0;height: 40px;text-align: center;line-height: 40px;color: #999">
                            友情安利
                        </div>
                    </div>
                    <div class="panel_left_posts random_anli">
                        <div class="card post_list_item post_list_details">
                            <a href="https://www.smartisan.com/pr/videos/smartisan-tnt-jianguo" target="_blank">smartisan </a>
<!--                            <a href="https://www.smartisan.com/jianguopro2/overview" target="_blank">pro2 </a>-->
                            <a href="https://www.zcool.com.cn/" target="_blank">zcool </a>
                            <a href="https://program-think.blogspot.com/" target="_blank">编程随想 </a>
                            <a href="https://www.ctfile.com/linker/43354819" target="_blank">城通网盘 </a>
                        </div>
                    </div>
                </div><!-- 友情链接 -->

            </div>
        </div>
        <!-- LEFT  -->

        <!-- MIDDLE  -->
        <div class="col_3of5">

            <!-- POSTS  -->
            <div class="post_list_container">

                <?php
                if (have_posts()) {
                    // Load posts loop.
                    while (have_posts()) {
                        the_post();
                        get_template_part('template-parts/content/content', get_theme_mod('display_excerpt_or_full_post', 'excerpt'));
                    }
                    // Previous/next page navigation.
                    // twenty_twenty_one_the_posts_navigation();
                }
                ?>
            </div>
            <!-- POSTS  -->

            <!-- PAGINATION  -->
            <div style="text-align: center;margin-top: 30px;">
                <div id="pagination"></div>
            </div>
            <!-- PAGINATION  -->

        </div>
        <!-- MIDDLE  -->

        <!-- RIGHT  -->
        <div class="col_1of5">

            <?php echo get_right_panel(); ?>

        </div>
        <!-- RIGHT  -->

    </div>


    <script>
        /* * * * * * * * * * * * * * * * *
     * Pagination
     * javascript page navigation
     * * * * * * * * * * * * * * * * */

        var Pagination = {

            code: '',

            // --------------------
            // Utility
            // --------------------

            // converting initialize data
            Extend: function (data) {
                data = data || {};
                Pagination.size = data.size || 300;
                Pagination.page = data.page || 1;
                Pagination.step = data.step || 3;
            },

            // add pages by number (from [s] to [f])
            Add: function (s, f) {
                for (var i = s; i < f; i++) {
                    Pagination.code += '<a>' + i + '</a>';
                }
            },

            // add last page with separator
            Last: function () {
                Pagination.code += '<i>...</i><a>' + Pagination.size + '</a>';
            },

            // add first page with separator
            First: function () {
                Pagination.code += '<a>1</a><i>...</i>';
            },


            // --------------------
            // Handlers
            // --------------------

            // change page
            Click: function () {
                Pagination.page = +this.innerHTML;
                Pagination.Start();
                Pagination.Jump(Pagination.page);
            },

            // previous page
            Prev: function () {
                Pagination.page--;
                if (Pagination.page < 1) {
                    Pagination.page = 1;
                }
                Pagination.Start();
                Pagination.Jump(Pagination.page);
            },

            // next page
            Next: function () {
                Pagination.page++;
                if (Pagination.page > Pagination.size) {
                    Pagination.page = Pagination.size;
                }
                Pagination.Start();
                Pagination.Jump(Pagination.page);
            },

            Jump: function (i) {
                location.href = '/page/' + i;
            },

            // --------------------
            // Script
            // --------------------

            // binding pages
            Bind: function () {
                var a = Pagination.e.getElementsByTagName('a');
                for (var i = 0; i < a.length; i++) {
                    if (+a[i].innerHTML === Pagination.page) a[i].className = 'current';
                    a[i].addEventListener('click', Pagination.Click, false);
                }
            },

            // write pagination
            Finish: function () {
                Pagination.e.innerHTML = Pagination.code;
                Pagination.code = '';
                Pagination.Bind();
            },

            // find pagination type
            Start: function () {
                if (Pagination.size < Pagination.step * 2 + 6) {
                    Pagination.Add(1, Pagination.size + 1);
                } else if (Pagination.page < Pagination.step * 2 + 1) {
                    Pagination.Add(1, Pagination.step * 2 + 4);
                    Pagination.Last();
                } else if (Pagination.page > Pagination.size - Pagination.step * 2) {
                    Pagination.First();
                    Pagination.Add(Pagination.size - Pagination.step * 2 - 2, Pagination.size + 1);
                } else {
                    Pagination.First();
                    Pagination.Add(Pagination.page - Pagination.step, Pagination.page + Pagination.step + 1);
                    Pagination.Last();
                }
                Pagination.Finish();
            },


            // --------------------
            // Initialization
            // --------------------

            // binding buttons
            Buttons: function (e) {
                var nav = e.getElementsByTagName('a');
                nav[0].addEventListener('click', Pagination.Prev, false);
                nav[1].addEventListener('click', Pagination.Next, false);
            },

            // create skeleton
            Create: function (e) {

                var html = [
                    '<a>&#9668;</a>', // previous button
                    '<span></span>',  // pagination container
                    '<a>&#9658;</a>'  // next button
                ];

                e.innerHTML = html.join('');
                Pagination.e = e.getElementsByTagName('span')[0];
                Pagination.Buttons(e);
            },

            // init
            Init: function (e, data) {
                Pagination.Extend(data);
                Pagination.Create(e);
                Pagination.Start();
            }
        };


        /* * * * * * * * * * * * * * * * *
        * Initialization
        * * * * * * * * * * * * * * * * */

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $count = ceil(wp_count_posts()->publish / 7);
        ?>

        var init = function () {
            Pagination.Init(document.getElementById('pagination'), {
                size: <?php echo $count ?>, // pages size
                page: <?php echo $paged ?>,  // selected page
                step: 3   // pages before and after current
            });
        };

        document.addEventListener('DOMContentLoaded', init, false);


    </script>
<?php
get_footer();
?>