<?php
/*
Template Name: Landing
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
		<!-- article section -->
        <?php

		// check if the repeater field has rows of data
		if( have_rows('rows') ):
		
		?>
        
        <div class="article-section">
        
        <?php
		
			$i = 1;
		
			// loop through the rows of data
			while ( have_rows('rows') ) : the_row();
		
		?>
			<article class="article<?php if($i % 2) {?> alignright<?php }?>">
				<div class="image">
					<div class="img-holder">
                    	<?php $image = get_sub_field('image'); ?>
						<img src="<?php echo $image['url'];?>" height="398" width="598" alt="">
					</div>
				</div>
				<div class="detail">
					<div class="detail-holder">
						<h2><?php the_sub_field('title');?></h2>
						<p><?php the_sub_field('description');?></p>
                        <?php if($url = get_sub_field('url')) { ?>
						<a href="<?php echo $url;?>" class="more">Read More</a>
                        <?php } ?>
					</div>
				</div>
			</article>
            
		<?php
		
			$i++;
		
			endwhile;
		?>
        
        </div>
        
        <?php 
		
		endif;
		
		?>
		<!-- featured area -->
		<section class="container featured-area">
			<div class="featured-box">
				<h2><span>FEATURED</span> Foodie Hero</h2>
				<!-- feature slideshow -->
				<div class="feature-slideshow">
					<div class="slideset">
                    <?php

					// check if the repeater field has rows of data
					if( have_rows('food_heroes', 82) ):
					
						// loop through the rows of data
						while ( have_rows('food_heroes', 82) ) : the_row();
					?>
							<div class="slide">
							<div class="img-holder">	
                            	<?php $hero_image = get_sub_field('image');?>
                                <?php if($hero_url = get_sub_field('url')) {?>
                                <a href="<?php echo $hero_url;?>" target="_blank">
								<?php }?>
                                <img src="<?php echo $hero_image['url'];?>" height="250" width="300" alt="<?php the_sub_field('name');?>">
                                <?php if($hero_url = get_sub_field('url')) {?>
                                </a>
								<?php }?>
							</div>
						</div>
					<?php
						endwhile;
					
					endif;
					
					?>
					</div>
					<div class="pagination">
						<!-- pagination generated here -->
					</div>
				</div>
			</div>
			<!-- partners box -->
			<div class="partners-box">
				<h2>PARTNERS</h2>
				<div class="partners-slider">
					<div class="mask">
						<div class="slideset">
                        	<div class="slide">
                        <?php

						// check if the repeater field has rows of data
						if( have_rows('partners', 82) ):
							
							$count = 1;
							
							// loop through the rows of data
							while ( have_rows('partners', 82) ) : the_row();
						?>
								<div class="slide-holder">
									<div class="logo-holder">
										<div class="logo-frame">
                                        <?php $partner_logo = get_sub_field('logo');?>
										<?php if($partner_url = 	get_sub_field('url')) {?>
                                            <a href="<?php echo $partner_url;?>" target="_blank">
                                        <?php }?>
												<img src="<?php echo $partner_logo['url'];?>" alt="<?php the_sub_field('name');?>">
										<?php if($partner_url) {?>
                                            </a>
                                        <?php }?>
										</div>
									</div>
								</div>
						<?php
						
							if($count == 2) {
								
								echo '</div><div class="slide">';
								$count = 0;
								
							}
						
							$count ++;
						
							endwhile;
						
						endif;
						
						?>
							</div>
						</div>
					</div>
					<a class="btn-prev" href="#"><i class="icon-left-open"></i></a>
					<a class="btn-next" href="#"><i class="icon-right-open"></i></a>
				</div>
				<ul class="more-links">
					<li><a href="/join-and-support/">Join and Support</a></li>
					<li><a href="/join-and-support/partnership-opportunities/">Learn More about becoming a Partner</a></li>
				</ul>
			</div>
		</section>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>

<?php get_footer(); ?>