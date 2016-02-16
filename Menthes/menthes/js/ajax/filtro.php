<?php 
	require('../../../../../wp-load.php'); 
	extract($_POST);
	$meta_key = (isset($cidade)) ? 'cidade_da_unidade' : 'estado_da_unidade';
	$busca = (isset($cidade)) ? $cidade : $sigla;
?>
	<option value=""><?php echo $label ?></option>
<?php 
	$args = array(
		'post_type'		=> 'unidade',
		'meta_key'		=> $meta_key,
		'meta_compare'	=> 'LIKE',
		'meta_value'	=> $busca,
		'orderby'		=> 'title',
		'order'			=> 'ASC'
	);
	query_posts( $args );
	while (have_posts()) : the_post(); 
		if(isset($cidade)) {
?>
			<option value="<?php echo mtbxr_val('endereco_da_unidade') ?>"><?php echo the_title(); ?></option>
<?php
		}
		else{
?>
			<option value="<?php echo mtbxr_val('cidade_da_unidade') ?>"><?php echo mtbxr_val('cidade_da_unidade') ?></option>
<?php
		}
	endwhile; 
	wp_reset_query(); 
?>