<?php get_header(); ?>

<section class="content">
	
	<?php get_template_part('inc/page-title'); ?>
	
	<div class="pad group">
		
		<?php while ( have_posts() ): the_post(); ?>
			<article <?php post_class(); ?>>	
				<div class="post-inner group">
					
					<h1 class="post-title"><?php the_title(); ?></h1>
					<p class="post-byline"><?php _e('by','hueman'); ?> <?php the_author_posts_link(); ?> &middot; <?php the_time(get_option('date_format')); ?></p>
					
					<?php if( get_post_format() ) { get_template_part('inc/post-formats'); } ?>
					
					<div class="clear"></div>
					
					<div class="entry <?php if ( ot_get_option('sharrre') != 'off' ) { echo 'share'; }; ?>">	
						<div class="entry-inner">
							<?php the_content(); ?>
							<?php wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','hueman'),'after'=>'</div>')); ?>
						</div>
						<?php if ( ot_get_option('sharrre') != 'off' ) { get_template_part('inc/sharrre'); } ?>
						<div class="clear"></div>				
					</div><!--/.entry-->
					
				</div><!--/.post-inner-->	
			</article><!--/.post-->				
		<?php endwhile; ?>
		
		<div class="clear"></div>
		
		<?php the_tags('<p class="post-tags"><span>'.__('Tags:','hueman').'</span> ','','</p>'); ?>

		<?php 
			$call_to_action_title = get_post_meta( get_the_ID(), 'call_to_action_title', true );
			$call_to_action_body = get_post_meta( get_the_ID(), 'call_to_action_body', true );
			$call_to_action_button_title = get_post_meta( get_the_ID(), 'call_to_action_button_title', true );
			$call_to_action_button_target = get_post_meta( get_the_ID(), 'call_to_action_button_target', true );
			// check if the custom field has a value
			if( ! empty( $call_to_action_title ) ) { ?>
			  <section class="cta-section">
			  	<h1 class="post-title cta-title"><?php echo $call_to_action_title; ?></h1>
				  	<div class="entry-inner cta-body">
					  	<p><?php echo $call_to_action_body; ?></p>
				  	</div>
				  	<a class="submit cta-button" href="<?php echo $call_to_action_button_target; ?>"><?php echo $call_to_action_button_title; ?></a>
			  </section>
			<?php } ?>
			
		
		<?php if ( ( ot_get_option( 'author-bio' ) != 'off' ) && get_the_author_meta( 'description' ) ): ?>
			<div class="author-bio">
				<div class="bio-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'128'); ?></div>
				<p class="bio-name"><?php the_author_meta('display_name'); ?></p>
				<p class="bio-desc"><?php the_author_meta('description'); ?></p>
				<div class="clear"></div>
			</div>
		<?php endif; ?>
		
		<?php if ( ot_get_option( 'post-nav' ) == 'content') { get_template_part('inc/post-nav'); } ?>
		
		<?php if ( ot_get_option( 'related-posts' ) != '1' ) { get_template_part('inc/related-posts'); } ?>
		
		<?php comments_template('/comments.php',true); ?>
		
	</div><!--/.pad-->
	
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>