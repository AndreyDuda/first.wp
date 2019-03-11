<!doctype html>
<?php language_attributes(); ?>
	<head>
		<meta charset=<?php bloginfo('charset'); ?>>
		<meta name="viewport" content="width=device-width">

        <?php wp_head(); ?>
	</head>
	<body>
		<div  class="wrapper">
            <header>
                <div class="header-top clearfix">
                    <a href="<?php echo home_url()?>" class="logo"><?php bloginfo('name');?></a>
                    <nav class="topmenu">
                        <div class="menu-button">MENU</div>
                        <?php
                            wp_nav_menu([
                                'theme_location' => 'top',
                                'container'      => null, //удаляем wp теги
                                'item_wrap'      => '<ul>%3$s</ul>'
                            ]);
                        ?>
                    </nav>
                </div>
                <?php if (is_active_sidebar('sidebar-top')) : ?>
                    <div  class="header-bottom">
                        <?php dynamic_sidebar('sidebar-top') ?>
                    </div>
                <?php endif; ?>
            </header>
            <div  class="content-wrapper clearfix">