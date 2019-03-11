<?php get_header(); ?>

    <main  class="clearfix">
        <div class="postFlow clearfix">
            <?php the_post(); ?>
            <article class="postItem-full">
                <a href= <?php the_permalink() ?>>
                    <?php the_post_thumbnail('large') ?>
                </a>
                <h2><?php the_title() ?></h2>
                <div><?php echo the_content() ?></div>
            </article>
        </div>
    </main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>