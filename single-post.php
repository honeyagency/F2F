<?php
/*
Template Name: Single Blog Post
*/
?>

<?php get_header(); ?>

<body>

	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php get_template_part( 'partials/page-header'); ?>
		<!-- two columns -->
		<div class="two-columns">
			<div class="container">
				<!-- main content part -->
				<section id="content">
					<div class="content-holder blog-post">
						<!-- breadcrumbs -->
						<?php 
                        $news_bread = '';
                        if(get_post_type() == 'post') { $news_bread = '<li><a href="/dig-in-blog/">Dig in Blog</a></li>'; }
                        echo get_breadcrumbs( $post, array( 'before_all' => '<ul class="breadcrumb"><li><a href="/">Home</a></li>' . $news_bread, 'after_all' => '</ul>', 'before_each' => '<li>', 'after_each' => '</li>', 'separator' => '' ) );
                        ?>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <h1><?php the_title(); ?></h1>
						<ul class="more-links">
							<li><time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('F j, Y'); ?></time></li>
							<li><?php the_author();?></li>
						</ul>
						<?php the_content();?>
                        <?php endwhile; else: ?>
                        	<p>Sorry, no content.</p>
                        <?php endif; ?>
					</div>
					<!-- socials block -->
					<?php get_template_part( 'partials/page-share'); ?>
				</section>
				<!-- main sidebar -->
				<?php get_template_part( 'partials/page-sidebar'); ?>
			</div>
		</div>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>
    
<?php get_footer(); ?>