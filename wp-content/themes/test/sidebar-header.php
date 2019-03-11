<?php if (is_home() && is_active_sidebar('sidebar-top')) : ?>
    <div  class="header-bottom">
        <?php dynamic_sidebar('sidebar-top') ?>
    </div>
<?php endif; ?>