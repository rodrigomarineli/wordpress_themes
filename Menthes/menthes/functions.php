<?php

//Initialize the update checker.
require 'theme-updates/theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
    'menthes',
    'https://github.com/rodrigomarineli/wordpress_themes/blob/master/Menthes/info.json'
);

require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'menthes_register_required_plugins' );


function menthes_register_required_plugins() {

	$plugins = array(

		array(
			'name'				=> 'Better Tinymce Shortcodes List',
			'slug'				=> 'better-shortcodes',
			'source'			=> get_template_directory() . '/lib/plugins/better-shortcodes.zip',
		),

		array(
			'name'				=> 'Contact Form 7',
			'slug'				=> 'contact-form-7',
			'source'			=> get_template_directory() . '/lib/plugins/contact-form-7.zip',
			'required'			=> true,
		),

		array(
			'name'				=> 'Custom Share Buttons with Floating Sidebar',
			'slug'				=> 'custom-share-buttons-with-floating-sidebar',
			'source'			=> get_template_directory() . '/lib/plugins/custom-share-buttons-with-floating-sidebar.zip',
		),

		array(
			'name'				=> 'WP Metaboxer Lite',
			'slug'				=> 'wp-metaboxer-lite',
			'source'			=> get_template_directory() . '/lib/plugins/wp-metaboxer-lite.zip',
			'required'			=> true,
		),

		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),

	);

	$config = array(
		'id'           => 'menthes',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}

/* WIDGETS */

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'			=> 'Sidebar',
		'before_widget'	=> '<div class="widget">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3>',
		'after_title'	=> '</h3>',
	));
	register_sidebar( array(
		'name' => 'Footer 1',
		'id' => 'footer-sidebar-1',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6><strong>',
		'after_title' => '</h6></strong>',
	) );
	register_sidebar( array(
		'name' => 'Footer 2',
		'id' => 'footer-sidebar-2',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6><strong>',
		'after_title' => '</h6></strong>',
	) );
	register_sidebar( array(
		'name' => 'Footer 3',
		'id' => 'footer-sidebar-3',
		'description' => 'Appears in the footer area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6><strong>',
		'after_title' => '</h6></strong>',
	) );
}

if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'primeiro_menu', 'Primeiro Menu' );
	register_nav_menu( 'segundo_menu', 'Segundo Menu' );
}

// Habilitando o uso das imagens destacadas ou post thumbnails
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_image_size('banner-slider', 570, 270, true);
}

/* INICIO SLIDER */
function chama_slide(){

	$html = '<header>';
	$html .= '<div class="cycle-slideshow" data-cycle-fx="fade" data-cycle-timeout="0" data-cycle-slides="> .slider" data-cycle-pager=".cycle-pager" >';
	$html .= '<div id="nav">';
	$html .= '<div class="cycle-pager"></div>';
	$html .= '</div>';
	$loop = new WP_Query( array( 'post_type' => 'Slider','showposts' => 10 ) );
	while ( $loop->have_posts() ) : $loop->the_post();
		$metodo_de_abertura = (mtbxr_val("metodo_de_abertura") == 0) ? '_top' : '_blank';
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
		$imagem = $thumb['0'];
		// $post_thumbnail_id = get_post_thumbnail_id();
		// $banner = wp_get_attachment_metadata( $post_thumbnail_id, $unfiltered );
		// $imagem = $banner['file'];
		$url = get_site_url();
		$html .= '<a href="'.mtbxr_val("link_do_slider").'" target="'.$metodo_de_abertura.'" class="slider" style="background: url('.$imagem.')"></a>';
	endwhile;
	wp_reset_query();
	$html .= '</div>';
	$html .= '</header>';

	return $html;
}
add_shortcode('mostra_slide', 'chama_slide');

/* FIM SLIDER */

/* SLIDER */
add_action( 'init', 'aba_slider' );
function aba_slider() {
	register_post_type( 'slider',
		array(
			'labels' => array(
				'name' => 'Slider',
				'singular_name' => 'Slider',
				'add_new' => 'Adicionar novo',
				'add_new_item' => 'Adicionar novo slider',
				'edit_item' => 'Editar Slider',
				'new_item' => 'Novo Slider',
				'all_items' => 'Todas os sliders',
				'view_item' => 'Ver Slider',
				'search_items' => 'Buscar Slider',
				'not_found' =>  'Nenhum slider encontrado',
				'not_found_in_trash' => 'Nenhum slider encontrado',
			),
			'supports' => array('title', 'thumbnail', 'page-attributes'),
			'public' => true,
			'menu_position' => 5,
			'has_archive' => false,
			'rewrite' => true,
			'exclude_from_search' => true,
			'menu_icon' => 'dashicons-desktop'
		)
	);
	flush_rewrite_rules( false );
}

/* UNIDADES */
add_action( 'init', 'aba_unidades' );
function aba_unidades() {
	register_post_type( 'unidade',
		array(
			'labels' => array(
				'name' => 'Unidades',
				'singular_name' => 'Unidade',
				'add_new' => 'Adicionar nova',
				'add_new_item' => 'Adicionar nova unidade',
				'edit_item' => 'Editar unidade',
				'new_item' => 'Nova unidade',
				'all_items' => 'Todos as unidade',
				'view_item' => 'Ver unidade',
				'search_items' => 'Buscar unidades',
				'not_found' =>  'Nenhum unidade encontrado',
				'not_found_in_trash' => 'Nenhum unidade encontrado',
			),
			'supports' => array('title'),
			'public' => true,
			'menu_position' => 22,
			'has_archive' => false,
			'rewrite' => true,
			'exclude_from_search' => true,
			'menu_icon' => 'dashicons-building'
		)
	);
	flush_rewrite_rules( false );
}

function NomeEstado($sigla) {
	switch ($sigla) {
		case 'AC':
			$nome = 'Acre';
			break;
		case 'AL':
			$nome = 'Alagoas';
			break;
		case 'AP':
			$nome = 'Amapá';
			break;
		case 'AM':
			$nome = 'Amazonas';
			break;
		case 'BA':
			$nome = 'Bahia';
			break;
		case 'CE':
			$nome = 'Ceará';
			break;
		case 'DF':
			$nome = 'Distrito Federal';
			break;
		case 'ES':
			$nome = 'Espirito Santo';
			break;
		case 'GO':
			$nome = 'Goiás';
			break;
		case 'MA':
			$nome = 'Maranhão';
			break;
		case 'MS':
			$nome = 'Mato Grosso do Sul';
			break;
		case 'MT':
			$nome = 'Mato Grosso';
			break;
		case 'MG':
			$nome = 'Minas Gerais';
			break;
		case 'PA':
			$nome = 'Pará';
			break;
		case 'PB':
			$nome = 'Paraíba';
			break;
		case 'PR':
			$nome = 'Paraná';
			break;
		case 'PE':
			$nome = 'Pernambuco';
			break;
		case 'PI':
			$nome = 'Piauí';
			break;
		case 'RJ':
			$nome = 'Rio de Janeiro';
			break;
		case 'RN':
			$nome = 'Rio Grande do Norte';
			break;
		case 'RS':
			$nome = 'Rio Grande do Sul';
			break;
		case 'RO':
			$nome = 'Rondônia';
			break;
		case 'RR':
			$nome = 'Roraima';
			break;
		case 'SC':
			$nome = 'Santa Catarina';
			break;
		case 'SP':
			$nome = 'São Paulo';
			break;
		case 'SE':
			$nome = 'Sergipe';
			break;
		case 'TO':
			$nome = 'Tocantins';
			break;
	}
	return $nome;
}

add_action( 'init', 'aba_depoimentos' );
function aba_depoimentos() {
	register_post_type( 'depoimentos',
		array(
			'labels' => array(
				'name' => 'Depoimentos',
				'singular_name' => 'Depoimento',
				'add_new' => 'Adicionar novo',
				'add_new_item' => 'Adicionar novo depoimento',
				'edit_item' => 'Editar depoimento',
				'new_item' => 'Novo depoimento',
				'all_items' => 'Todos os depoimentos',
				'view_item' => 'Ver depoimento',
				'search_items' => 'Buscar depoimentos',
				'not_found' =>  'Nenhum depoimento encontrado',
				'not_found_in_trash' => 'Nenhum depoimento encontrado',
			),
			'supports' => array('title','thumbnail','editor'),
			'public' => true,
			'menu_position' => 22,
			'has_archive' => false,
			'rewrite' => true,
			'exclude_from_search' => true,
			'menu_icon' => 'dashicons-testimonial'
		)
	);
	flush_rewrite_rules( false );
}


function full_banner($conteudo){


	$padding = (!isset($conteudo['botao'])) ? 'style="padding-top: 170px;"' : '';
	$html = '<article>';
	$html .= '<div class="bg_fixed '.$conteudo['border'].'" style="background: url('.$conteudo['banner'].') 50% top repeat fixed;">';
	$html .= '<div class="content text-center" '.$padding.'>';
	$html .= '<h3>'.$conteudo['titulo'].'</h3>';
	$html .= '<h3>'.$conteudo['subtitulo'].'</h3>';
	if(isset($conteudo['botao'])) {
		$html .= '<hr>';
		$html .= '<img src="'.$conteudo['icone'].'" alt="'.$conteudo['titulo'].'"><br/>';
		$html .= '<a href="'.$conteudo['link'].'"><strong>'.$conteudo['botao'].'</strong></a>';
		$html .= '<img class="selo" src="'.$conteudo['selo'].'" alt="Selo de Excelência">';
	}
	else if(isset($conteudo['selo'])) { 
		$html .= '<img class="selo" src="'.$conteudo['selo'].'" alt="Selo de Excelência">';
	}
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</article>';

	return $html;
}
add_shortcode('add_full_banner', 'full_banner');

function col_2($atts, $content = null) {
	$class = (isset($atts['class'])) ? $atts['class'] : '';
	$html .= '<div class="col-2 '.$class.'">';
	$html .= do_shortcode($content);
	$html .= '</div>';

	return $html;
}
add_shortcode('col_2', 'col_2');

function row($atts, $content = null) {
	$html = '<article>';
	$html .= '<div class="content text-center">';
	$html .= do_shortcode($content);
	$html .= '</div>';
	$html .= '</article>';

	return $html;
}
add_shortcode('row', 'row');

function accordion($atts, $content = null) {
	$html .= '<div id="accordion">';
	$html .= do_shortcode($content);
	$html .= '</div>';

	return $html;
}
add_shortcode('accordion', 'accordion');

function div($atts, $content = null) {
	$html .= '<div id="'.$atts['id'].'">';
	$html .= do_shortcode($content);
	$html .= '</div>';

	return $html;
}
add_shortcode('div', 'div');

function section($atts, $content = null) {
	if(isset($atts['color'])) {
		echo '<style>
			section#cursos article div ul > li a { color: #'.$atts['color'].';}
			section#cursos article div ul > li img { background: #'.$atts['color'].';}
			section#cursos article .bg_fixed div a { background: #'.$atts['color'].';}
			section#cursos article em { color: #'.$atts['color'].';}
			section#cursos article .bg_fixed.border-top { border-top: 13px solid #'.$atts['color'].'; }
			section#cursos article .bg_fixed.border-bottom { border-bottom: 13px solid #'.$atts['color'].'; }
			section#cursos article #accordion h4 { background: #'.$atts['color'].'; }
			section#cursos article .col-2 p {background: #'.$atts['color'].';}
			section#cursos article ol li:nth-child(odd) { background: #'.$atts['color'].';}
			section article a.btn { background: #'.$atts['color'].';}
		</style>';
	}
	$id = (isset($atts['id'])) ? $atts['id'] : 'cursos';
	$html = '<section id="'.$id.'">';
	$html .= do_shortcode($content);
	$html .= '</section>';
	return $html;
}
add_shortcode('section', 'section');

function botao($conteudo) {
	$html .= '<a class="btn" href="'.$conteudo['link'].'"><strong>'.$conteudo['titulo'].'</strong></a>';

	return $html;
}
add_shortcode('botao', 'botao');

function depoimentos($conteudo){
	$posts_per_page = (isset($conteudo['posts_per_page'])) ? $conteudo['posts_per_page'] : 3;
	if(isset($conteudo['dep']))
		query_posts('posts_per_page='.$posts_per_page.'&post_type=depoimentos&meta_key='.$conteudo['dep'].'&meta_value=1&orderby=id&order=DESC');
	else
		query_posts('posts_per_page='.$posts_per_page.'&post_type=depoimentos&orderby=id&order=DESC');
	while (have_posts()) : the_post(); 
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
		$image = $thumb['0'];
			$html .= '<div class="depoimento">';
			$html .= '<div class="video">';
			if(mtbxr_val("video_do_depoimento")) {
				$html .= '<a class="light_video" href="'.mtbxr_val("video_do_depoimento").'"><i class="icon icon_play"></i></a>';
			}
			$html .= '</div>';
			$html .= '<img src="'.$image.'" alt="'.get_the_title().'">';
			$html .= '<span>'.get_the_title().'</span>';
			$html .= '<p>'.get_the_content().'</p>';
			$html .= '</div>';
	endwhile; 
	wp_reset_query(); 

	return $html;

}
add_shortcode('depoimentos', 'depoimentos');

function mapa($conteudo){

	$html = '<article class="mapa" id="unidades">';
	$html .= '<div id="map"></div>';
	$html .= '<div id="busca_unidade">';
	$html .= '<div class="content">';
	$html .= '<div id="tabs">';
	$html .= '<ul>';
	$html .= '<li><a href="#tabs-1"><strong>UNIDADES</strong></a></li>';
	$html .= '<li><a href="#tabs-2"><strong>BUSCA POR ENDEREÇO</strong></a></li>';
	$html .= '</ul>';
	$html .= '<div id="tabs-1">';
	$html .= '<form action="">';
	$html .= '<h5><strong>Unidades Menthes</strong></h5>';
	$html .= '<select name="" id="estado">';
	$html .= '<option value="">Estados</option>';
	query_posts('posts_per_page=-1&post_type=unidade&orderby=title&order=ASC' );
	while (have_posts()) : the_post(); 
		$estado = mtbxr_val("estado_da_unidade");
		$nome_estado = NomeEstado($estado[0]);
		$html .= '<option value="'.$estado[0].'">'.$nome_estado.'</option>';
	endwhile; 
	wp_reset_query(); 
	$html .= '</select>';
	$html .= '<select name="" id="cidade">';
	$html .= '<option value=""></option>';
	$html .= '</select>';
	$html .= '<select name="" id="unidade">';
	$html .= '<option value=""></option>';
	$html .= '</select>';
	$html .= '</form>';
	$html .= '</div>';
	$html .= '<div id="tabs-2">';
	$html .= '<h5><strong>Endereço</strong></h5>';
	$html .= '<input type="text" name="endereco" id="autocomplete">';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</article>';

	return $html;

}
add_shortcode('mapa', 'mapa');

function RedeSocial($conteudo){
	if(isset($conteudo)){
		if($conteudo['rede'] == 'facebook')
			$html = '<div class="fb-page" data-href="https://www.facebook.com/menthescursos" data-tabs="timeline" data-height="497" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/menthescursos"><a href="https://www.facebook.com/menthescursos">Menthes Cursos</a></blockquote></div></div>';
		if($conteudo['rede'] == 'twitter')
			$html = '<div><a class="twitter-timeline" href="https://twitter.com/MenthesCursos" data-widget-id="690207121833619457">Tweets de @MenthesCursos</a></div>';
		if($conteudo['rede'] == 'instagram') {
			$url = get_site_url();
			$html = '<div>';
			$html .= '<img src="'.$url.'/wp-content/themes/menthes/images/instagram.png" alt="Menthes Cursos" class="left">';
			$html .= '<div class="left">';
			$html .= '<h5><strong>menthescursos</strong></h5>';
			$html .= '<a href="https://www.instagram.com/menthescursos/" target="_blank" class="btn_follow">Seguir</a>';
			$html .= '</div>';
			$html .= '</div>';
		}
		if($conteudo['rede'] == 'youtube') {
			$html = '<div class="g-ytsubscribe" style="padding: 34px;" data-channelid="UC0glFPio-WSMy0DjKMfMmKg" data-layout="full" data-count="default" data-onytevent="onYtEvent"></div>';
		}
	}

	return $html;
}
add_shortcode('rede_social', 'RedeSocial');



function wp_custom_breadcrumbs() {

	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = ''; // delimiter between crumbs
	$home = 'Home'; // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb

	global $post;
	$homeLink = get_bloginfo('url');

	if (is_home() || is_front_page()) {
		if ($showOnHome == 1) 
			echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>';
	} else {
		echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
				echo $before . 'categoria "' . single_cat_title('', false) . '"' . $after;
		} elseif ( is_search() ) {
			echo $before . 'Search results for "' . get_search_query() . '"' . $after;
		} elseif ( is_day() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
				if ($showCurrent == 1) 
					echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} else {
				echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">Blog</a></li>';
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				if ($showCurrent == 0) 
					$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
				// echo '<li>'.$cats.'</li>';
				if ($showCurrent == 1) 
					echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
			if ($showCurrent == 1)
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1)
				echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) 
					echo ' ' . $delimiter . ' ';
			}
			if ($showCurrent == 1) 
				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
		} elseif ( is_tag() ) {
			echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . 'Articles posted by ' . $userdata->display_name . $after;
		} elseif ( is_404() ) {
			echo $before . 'Error 404' . $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
	}
} // end wp_custom_breadcrumbs()

function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<div class="autor_comentario">
		<div class="comment-author vcard">
		<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
			?>
		</div>
	</div>

	<?php comment_text(); ?>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}


include('lib/classes/nav-menu-dropdown.php' );
function be_mobile_menu() {
	wp_nav_menu( array(
		'theme_location' => 'mobile',
		'walker'         => new Walker_Nav_Menu_Dropdown(),
		'items_wrap'     => '<div class="mobile-menu"><form><select onchange="if (this.value) window.location.href=this.value">%3$s</select></form></div>',
	) );	
}
add_action( 'genesis_before_header', 'be_mobile_menu' );

?>