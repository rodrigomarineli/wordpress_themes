	<footer>
		<div class="content">
			<div class="row">
				<div class="col-2">
					<?php
						if(is_active_sidebar('footer-sidebar-1')){
							dynamic_sidebar('footer-sidebar-1');
						}
					?>
					<!-- <p>Franqueadora Menthes<br/>
					Clemente Ferreira, 666, Alto da Boa Vista<br/>
					Ribeirão Preto, São Paulo<br/>
					<strong>16 3602.9420</strong></p> -->
				</div>
				<div class="col-2">
					<?php
						if(is_active_sidebar('footer-sidebar-2')){
							dynamic_sidebar('footer-sidebar-2');
						}
					?>
				</div>
				<div class="col-2">
					<?php
						if(is_active_sidebar('footer-sidebar-3')){
							dynamic_sidebar('footer-sidebar-3');
						}
					?>
				</div>
			</div>
			<div class="top">
				<a  href="#"><img src="<?php bloginfo('template_directory'); ?>/images/icon/arrow_top.png" alt=""></a>
			</div>
		</div>
		<div id="copyright">
			<p class="text-center">© Menthes. Todos os direitos reservados.</p>
		</div>
	</footer>
	<script type="text/javascript"> var template_url = "<?php bloginfo('template_url'); ?>"; </script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle2.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&language=pt-BR"></script>
	<script src="https://apis.google.com/js/platform.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.nav.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.colorbox-min.js"></script>
	<script type="text/javascript" src="/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js"></script>
	<script type="text/javascript" src="/wp-content/plugins/contact-form-7/includes/js/scripts.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>
</body>
</html>