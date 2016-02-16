<?php
/*
Template Name: Home
*/
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Menthes
 * @since Menthes 1.0
 */

get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<section id="home">
			<?php echo the_content(); ?>
		</section>
	<?php wp_reset_query(); ?>
	<?php endwhile; else: ?>
		<div class="artigo">
			<h2>Nada Encontrado</h2>
			<p>Erro 404</p>
			<p>Lamentamos mas não foram encontrados artigos.</p>
		</div>			
	<?php endif; ?>
<?php get_footer(); ?>