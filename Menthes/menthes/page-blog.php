<?php
/*
Template Name: Blog
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
				<section class="breadcrumbs">
					<ul class="content">
					<?php wp_custom_breadcrumbs(); ?>
					</ul>
				</section>
				<?php the_content(); ?>
				<section id="blog">
					<?php query_posts('showposts=8'); ?>
					<article>
						<div class="content text-center" id="posts_blog">
							<?php 
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
						</div>
						<div class="content text-center">
							<div class="load"><img src="<?php bloginfo('template_directory'); ?>/images/ajax-loader.gif" alt=""></div>
							<a href="" class="load_more">CARREGAR MAIS <br/><span></span></a><br>
							<a class="btn margin_20" href="http://www.menthes.com.br/"><strong><strong>CONHEÇA NOSSOS CURSOS</strong></strong></a>
						</div>
					</article>
				</section>
			<?php wp_reset_query(); ?>
			<?php endwhile; else: ?>
				<div class="artigo">
					<h2>Nada Encontrado</h2>
					<p>Erro 404</p>
					<p>Lamentamos mas não foram encontrados artigos.</p>
				</div>			
			<?php endif; ?>
			
		
		<?php // get_sidebar(); ?>
<?php get_footer(); ?>