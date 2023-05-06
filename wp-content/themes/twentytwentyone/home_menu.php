<?php
?>


<!-- NAV -->
<nav class="nav card">
    <ul>
        <li>
            <a href="/">
                <span class="MenuText <?php echo $args['cate'] == 0 ? 'active' : '' ?>">首页</span>
            </a>
        </li>
        <?php foreach (get_categories([
            'hide_empty' => false,
            'orderBy' => 'term_id',
            'order' => 'ASC',
            'parent' => 0
        ]) as $item): ?>
            <?php if ($item->term_id != 1): ?>
                <li>
                    <a href="<?php echo get_category_link($item->term_id) ?>">
                        <span class="MenuText <?php echo $args['cate'] == $item->term_id ? 'active' : '' ?>"><?php echo $item->name ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <li>
            <a href="<?php echo get_permalink(get_page_by_path('matter')) ?>">
                <span class="MenuText <?php echo $args['cate'] == -1 ? 'active' : '' ?>">Matter</span>
            </a>
        </li>
        <li>
            <a href="<?php bloginfo('rss2_url'); ?>">
                <span class="MenuText">RSS</span>
            </a>
        </li>
    </ul>
</nav>
<!-- NAV -->