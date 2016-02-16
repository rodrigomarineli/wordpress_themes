<?php 
	require('../../../../../wp-load.php'); 
	extract($_POST);

	query_posts('showposts=8&offset='.$qtd_posts);
	while (have_posts()) : the_post(); 
		$content = strip_tags(get_the_content());
?>
	<div class="post">
<?php
		if ( has_post_thumbnail() ) {
?>
			<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
<?php
		}
?>
		<div class="textos">
			<a href="<?php the_permalink() ?>"><h3><strong><?php the_title(); ?></strong></h3>
			<p><?php echo substr($content, 0, 35).' ...'; ?></p>
			<small><em><?php the_time('M d, Y') ?></em></small></a>
		</div>
	</div>
<?php endwhile;?>
