<?php
	/*
	Template Name: Контент на фоне карты
	Template post type: page
	*/
?>

<?php get_header(); ?>

<main class="clearfix">
	<div class="postsFlow clearfix">
		<?php the_post(); ?>
		<article class="page-full">
			<div>КАРТА</div>
			<h2><?php the_title() ?></h2>
			<div><?php the_content() ?></div>
		</article>
	</div>
</main>
<?php get_footer(); ?>