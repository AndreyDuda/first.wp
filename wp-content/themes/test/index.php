<?php get_header(); ?>

    <main  class="clearfix">
        <?php if (have_posts()) :
                while (have_posts()):
                    the_post(); ?>
                    <article class="postItem">
                        <a href= <?php the_permalink() ?>>
                            <?php the_post_thumbnail('thumbnail') ?>
                        </a>
                        <h2><?php the_title() ?></h2>
                        <span>This work description goes here. Just
                                simple and short text about this work.</span>
                    </article>
                <?php endwhile; ?>
        <?php else: ?>
            Записей нет
        <?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
