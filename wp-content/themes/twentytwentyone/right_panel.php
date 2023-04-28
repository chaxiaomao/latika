<?php
?>


<div class="panel_right">

    <!-- SEARCH -->
    <div class="card">
        <section>
            <form action="<?php echo get_site_url() ?>" method="get" autocomplete="off">
                <input type="text" name="s" placeholder="Find your article"/>
                <label for="favorite" class="checkbox">
                    <input type="checkbox" id="favorite" name="favorite"/>
                    Google 搜索
                </label>
                <input class="button-83" role="form" type="submit" value="Search" style="width: 100%" />
            </form>
        </section>
    </div>
    <!-- SEARCH -->

    <!-- TAGS -->
    <div class="card">
        <section>
            <ul class="tags">
                <?php foreach (get_tags([
                    'taxonomy' => 'post_tag',
                    'orderby' => 'id',
                ]) as $item): ?>
                    <li><a href="<?php echo get_tag_link($item->term_id) ?>"
                           class="tag"><?php echo $item->name ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>
    <!-- TAGS -->

    <!-- todo 数字->小圆点-->
    <div class="post_list_container">
        <?php foreach (get_categories(['hide_empty' => false]) as $item): ?>
            <?php if ($item->term_id != 1): ?>
                <div class="card post_list_item">
                    <div class="post_list_details">
                        <a href="<?php echo get_category_link($item->term_id) ?>"><?php echo $item->name . " (" . $item->count . ")" ?></a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <!-- CATE  -->

</div>