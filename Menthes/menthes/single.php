<?php get_header(); ?>
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<section class="breadcrumbs">
					<ul class="content">
					<?php wp_custom_breadcrumbs(); ?>
					</ul>
				</section>
				<section id="blog" class="single">
					<article>
						<div class="content text-center">
							<h1><strong><?php the_title(); ?></strong></h1>
							<?php
									if ( has_post_thumbnail() ) {
							?>
										<div class="img_single">
											<?php the_post_thumbnail(); ?>
											<time><strong><?php the_time('d/M') ?></strong></time>
										</div>
							<?php
									}
							?>
							<!-- <p>Postado por <?php the_author() ?> em <?php the_time('d/M/Y') ?> - <?php comments_popup_link('Sem Comentários', '1 Comentário', '% Comentários', 'comments-link', ''); ?> <?php edit_post_link('(Editar)'); ?></p> -->
							<div class="texto"><?php the_content(); ?></div>
						</div>
					</article>
				<?php comments_template();  ?>
					<?php 
						wp_reset_query();
						query_posts('showposts=4'); 
					?>
					<article>
						<div class="content text-center" id="posts_blog">
							<h4><strong>ÚLTIMOS</strong> <em>Posts</em></h4>
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
			
		
		<?php //get_sidebar(); ?>
<?php get_footer(); ?>