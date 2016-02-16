<?php require('../../../../../wp-load.php'); ?>

eqfeed_callback(

	{
		"features":
		[
<?php

	query_posts('posts_per_page=-1&post_type=unidade&orderby=title&order=ASC' );

	while (have_posts()) : the_post(); 
	$estado = mtbxr_val("estado_da_unidade");

?>

			{
				"properties":
				{
					"place":"<?php echo mtbxr_val("endereco_da_unidade") ?>",
					"tel":"<?php echo mtbxr_val("telefone_da_unidade") ?>",
					"email":"<?php echo mtbxr_val("email_da_unidade") ?>",
					"title":"<?php the_title(); ?>",
					"url":"<?php echo mtbxr_val("site_da_unidade") ?>",
					"facebook":"<?php echo mtbxr_val("facebook_da_unidade") ?>",
					"twitter":"<?php echo mtbxr_val("twitter_da_unidade") ?>",
					"instagram":"<?php echo mtbxr_val("instagram_da_unidade") ?>",
					"cidade":"<?php echo mtbxr_val("cidade_da_unidade").'/'.$estado[0] ?>"
				},
			},

<?php 
	endwhile; 
	wp_reset_query(); 
?>
		],
	}
);