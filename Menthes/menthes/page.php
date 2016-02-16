<?php get_header(); ?>
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<section class="breadcrumbs">
					<ul class="content">
					<?php wp_custom_breadcrumbs(); ?>
					</ul>
				</section>
				<?php the_content(); ?>
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