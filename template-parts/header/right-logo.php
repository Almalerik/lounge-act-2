<?php
$description = get_bloginfo ( 'description', 'display' );
?>
<nav class="navbar navbar-default">
	<div class="navbar-header">
	
		<?php if ( has_nav_menu( "primary" ) ) :?>
		<button type="button" class="navbar-toggle collapsed" data-toggle="<?php echo ! $loungeact -> get_setting('menu_slide') ? 'collapse' : $loungeact -> get_setting('menu_slide');?>" data-target="#navbar-mobile" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar top-bar"></span>
			<span class="icon-bar middle-bar"></span>
			<span class="icon-bar bottom-bar"></span>
		</button>
		<?php endif; ?>
		
		<?php if ( has_nav_menu( "primary" ) ) :?>
		<div id="navbar" class="loungeact-navbar navbar-collapse collapse">
			<?php wp_nav_menu( 
					array( 
							'theme_location' => 'primary', 
							'menu_id' => 'primary-menu', 
							'container' => false,
							'link_before' => '<span class="loungeact-link-before">[</span>',
							'link_after' =>'<span class="loungeact-link-after">]</span>',
							'walker' => new LoungeAct_Walker(), 
							'menu_class' => 'nav navbar-nav navbar-left loungeact-menu'
			) ); ?>
		</div>
		<?php endif; ?>
		
		<div class="brand-container text-right">
			<div class="navbar-brand-name">
			<?php if ( is_front_page() && is_home() ): ?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php if ($description || is_customize_preview ()) :?>
					<small class="site-description"><?php echo $description; ?></small>
					<?php endif;?>
				</h1>
			<?php else: ?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php if ($description || is_customize_preview ()) :?>
					<small class="site-description"><?php echo $description; ?></small>
					<?php endif;?>
				</p>
			<?php endif;?>
			</div>
			<div class="navbar-brand-logo">
				<a href="<?php echo esc_url( home_url( '/' ) );?>" rel="home">
					<img src="<?php echo $loungeact->get_logo();?>" alt="<?php echo get_bloginfo('title');?>" class="site-logo image-responsive">
				</a>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php if ( has_nav_menu( "primary" ) ) :?>
		<div id="navbar-mobile" class="loungeact-navbar-mobile collapse <?php echo $loungeact -> get_setting('menu_slide');?>">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false, 'walker' => new LoungeAct_Walker(), 'menu_class' => 'nav navbar-nav navbar-right loungeact-menu'  ) ); ?>
		</div>
	<?php endif; ?>
	</div>
</nav>
