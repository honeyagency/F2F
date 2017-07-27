<?php
/*
Template Name: Adventure Guide
*/
?>

<?php get_header(); ?>

<body>
<!-- google tag manager -->
	<?php get_template_part( 'partials/piece-gatags'); ?>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php get_template_part( 'partials/page-header'); ?>
		<!-- visual section -->
		<section class="visual add landing">
			<div class="img-holder">
				<div class="img-frame">
                	<?php $main_image = get_field('main_image'); ?>
					<img src="<?php echo $main_image['url'];?>" height="343" width="1200" alt="">
				</div>
			</div>
			<div class="caption">
				<div class="caption-holder">
					<div class="container">
						<div class="caption-box">
							<div class="box-holder">
								<strong class="title"><?php the_title();?></strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        <div class="container adventure">
			<div class="detail">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
                        <?php endwhile; else: ?>
                        	<p>Sorry, no content.</p>
                        <?php endif; ?>
			</div>
		</div>
        
		<div class="twocolumns container add">
			<section class="adventure-block">
            	<h2>Choose Your Adventure</h2>
                <?php

				// check if the repeater field has rows of data
				if( have_rows('adventures') ):
				?>
                <ul>
                <?php
					// loop through the rows of data
					while ( have_rows('adventures') ) : the_row();
				?>
                	<li>
                    	<img src="<?php $image = get_sub_field('image'); echo $image['url'];?>">
                    	<strong class="title"><a href="<?php the_sub_field('url');?>"><?php the_sub_field('title');?></a></strong>
                    	<?php the_sub_field('description');?>					
                    </li>
				<?php
					endwhile;
				?>
                </ul>
				<?php
				endif;
				?>
			</section>
            <aside id="sidebar">
				<div class="quiz-box">
					<?php the_field('quiz');?>
				</div>
			</aside>
            <section class="tips-block">
            	<h2><?php the_field('tips_header');?></h2>
                <?php

				// check if the repeater field has rows of data
				if( have_rows('tips') ):
				?>
                <ul>
                <?php
					// loop through the rows of data
					while ( have_rows('tips') ) : the_row();
				?>
                	<li>
                    	<img src="<?php $image = get_sub_field('image'); echo $image['url'];?>">
                    	<strong class="title"><?php the_sub_field('title');?></strong>
                    	<?php the_sub_field('description');?>					
                    </li>
				<?php
					endwhile;
				?>
                </ul>
				<?php
				endif;
				?>
                <div class="footer-link">
                	<p><a href="<?php the_field('footer_link_url');?>"><?php the_field('footer_link_text');?></a></p>
                </div>
            </section>
		</div>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>

<?php get_footer(); ?>