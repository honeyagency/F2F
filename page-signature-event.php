<?php
/*
Template Name: Signature Event
*/
?>

<?php get_header(); ?>


<body>

	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php get_template_part( 'partials/page-header'); ?>
		<!-- visual section -->
        <?php if($header_images = get_field('header_images')) {?>
		<div class="visual-box">
			<div class="images one">
				<div class="img-holder">
					<img src="<?php echo $header_images[0]['url'];?>" height="240" width="240" alt="">
				</div>
				<div class="img-holder">
					<img src="<?php echo $header_images[1]['url'];?>" height="240" width="240" alt="">
				</div>
			</div>
			<div class="images">
				<img src="<?php echo $header_images[2]['url'];?>" height="480" width="480" alt="">
			</div>
			<div class="images mobile">
				<div class="img-holder">
					<div class="image">
						<img src="<?php echo $header_images[3]['url'];?>" height="240" width="240" alt="">
					</div>
					<div class="image">
						<img src="<?php echo $header_images[4]['url'];?>" height="240" width="240" alt="">
					</div>
				</div>
				<div class="img-holder">
					<div class="image">
						<img src="<?php echo $header_images[5]['url'];?>" height="240" width="480" alt="">
					</div>
					<div class="image">
						<img src="<?php echo $header_images[6]['url'];?>" height="240" width="480" alt="">
					</div>
				</div>
			</div>
		</div>
        <?php } ?>
		<div class="container">
			<!-- breadcrumbs -->
			<?php 
			$news_bread = '';
			if(get_post_type() == 'event') { $news_bread = '<li><a href="/events/">Events</a></li>'; }
			echo get_breadcrumbs( $post, array( 'before_all' => '<ul class="breadcrumb"><li><a href="/">Home</a></li>' . $news_bread, 'after_all' => '</ul>', 'before_each' => '<li>', 'after_each' => '</li>', 'separator' => '' ) );
			?>
			<!-- three columns -->
			<div class="three-columns">
				<!-- content block -->
				<div class="content-block">
					<aside class="event-detail">
                    <?php if($startDate = get_field('field_558b9672c7fdf')){ ?>
						<div class="date-title">
							<div class="date <?php if($endDate = get_field('field_5b6201e24caa3')){echo 'end'; } ?>">
                            <?php $startDate = DateTime::createFromFormat('Ymd', $startDate); ?>
								<time datetime="<?php echo $startDate->format('Y-m-d');?>">
									<div><?php echo $startDate->format('M');?></div>
									<span><?php echo $startDate->format('d');?></span>
								</time>
								<?php if($endDate){ ?>
							<?php $endDate = DateTime::createFromFormat('Ymd', $endDate); ?>
								<time datetime="<?php echo $endDate->format('Y-m-d');?>">
									<span><span class="dash"> - </span><?php echo $endDate->format('d');?></span>
								</time>
								<?php } ?>
							</div>
							
						</div>
                    <?php } ?>
						<div class="detail-holder">
							<h2>Event Details</h2>
							<?php the_field('details');?>
						</div>
						<!-- location area -->
						<div class="location-area tablet">
                        	<?php if(($location = get_field('address')) && $location['lat'] && $location['lng']) {?>
							<div class="widget">
                            	<div class="location">
                                    <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $location['lat'];?>,+<?php echo $location['lng'];?>&zoom=17&scale=true&size=220x220&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0x159a34%7Clabel:%7C<?php echo $location['lat'];?>,+<?php echo $location['lng'];?>" alt="">
                                </div>
								<a href="https://maps.google.com?daddr=<?php echo $location['address'];?>" class="direction" target="_blank">Get Directions</a>
							</div>
                            <?php }?>
                            <?php if($organization_logo = get_Field('organization_logo')) {?>
							<div class="widget presented">
								<strong class="title">Presented by</strong>
								<div class="lexus-logo">
                                <?php if($organization_url = get_field('organization_url')) {?>
                                <a href="<?php echo $organization_url;?>" target="_blank">
                                <?php }?>
									<img src="<?php echo $organization_logo['url'];?>" width="222" alt="">
                                <?php if($organization_url = get_field('organization_url')) {?>
                                </a>
                                <?php }?>

								</div>
							</div>
                            <?php }?>
						</div>
					</aside>
					<!-- main content part -->
					<section class="content">
						<div class="content-box">
						<?php if($startDate){ ?>
                            <div class="date-title">
								<div class="date <?php if($endDate){echo 'end'; } ?>">
									<time datetime="<?php echo $startDate->format('Y-m-d');?>">
										<div><?php echo $startDate->format('M');?></div>
										<span><?php echo $startDate->format('d');?></span>
									</time>
										<?php if($endDate){ ?>
								<time datetime="<?php echo $endDate->format('Y-m-d');?>">
									<span><span class="dash"> - </span><?php echo $endDate->format('d');?></span>
								</time>
								<?php } ?>
								</div>
							</div>
                        <?php }?>
							<div class="content-holder">
								<h1><?php the_title();?></h1>
                                <?php if($organization_name = get_Field('organization_name')) {?>
								<span class="sub-heading">Presented by 
									<?php if($organization_url = get_field('organization_url')) {?>
                                    <a href="<?php echo $organization_url;?>" target="_blank">
                                    <?php }?>
                                        <?php echo $organization_name;?>
                                    <?php if($organization_url = get_field('organization_url')) {?>
                                    </a>
                                    <?php }?>
                                </span>
                                <?php } ?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content();?>
                                <?php endwhile; else: ?>
                                <p>Sorry, no content.</p>
                                <?php endif; ?>
							</div>
							<div class="socials-block">
                            	<?php if($eventTicketUrl = get_field('eventTicketUrl')) {?>
                                <a class="btn-default" href="<?php echo $eventTicketUrl;?>" target="_blank">Tickets</a>
                                <?php }?>
								<!-- Go to www.addthis.com/dashboard to customize your tools -->
								<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5599f4644169f278" async="async"></script>
        
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="socials-list">
                                <div class="addthis_sharing_toolbox"></div>
                                </div>
							</div>
						</div>
						<ul class="more-links">
							<li><a href="/events/">More Events</a></li>
						</ul>
					</section>
				</div>
				<!-- location area -->
				<aside class="location-area">
                	<?php if($location && $location['lat'] && $location['lng']) {?>
					<div class="widget">
						<div class="location">
							<img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $location['lat'];?>,+<?php echo $location['lng'];?>&zoom=17&scale=true&size=220x220&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0x159a34%7Clabel:%7C<?php echo $location['lat'];?>,+<?php echo $location['lng'];?>" alt="">
						</div>
                        <a href="https://maps.google.com?daddr=<?php echo $location['address'];?>" class="direction" target="_blank">Get Directions</a>
					</div>
                    <?php }?>
                    <?php if($organization_logo) {?>
                    <div class="widget presented">
                        <strong class="title">Presented by</strong>
                        <div class="lexus-logo">
                        <?php if($organization_url = get_field('organization_url')) {?>
                            <a href="<?php echo $organization_url;?>" target="_blank">
                        <?php }?>
                            <img src="<?php echo $organization_logo['url'];?>" width="222" alt="">
                        <?php if($organization_url = get_field('organization_url')) {?>
                            </a>
                        <?php }?>
                        </div>
                    </div>
                    <?php }?>
				</aside>
			</div>
			<!-- sponsors block -->
            <?php

			// check if the repeater field has rows of data
			if( have_rows('sponsors') ):
			?>
            <section class="sponsors-block">
				<h2><?php the_field('sponsors_title');?></h2>
				<div class="sponsor-slider">
					<div class="mask">
						<div class="slideset">
            <?php
				// loop through the rows of data
				while ( have_rows('sponsors') ) : the_row();
			?>
							<div class="slide">
                            <div class="slide-holder">
                                <div class="logo-holder">
                                    <div class="logo-frame">
                                    <?php $sponsor_logo = get_sub_field('logo');?>
                                    <?php if($sponsor_url = 	get_sub_field('sponsor_url')) {?>
                                        <a href="<?php echo $sponsor_url;?>" target="_blank">
                                    <?php }?>
                                    <?php if($sponsor_logo) {?>
                                            <img width="150" src="<?php echo $sponsor_logo['url'];?>" alt="<?php echo get_sub_field('sponsor_name');?>">
                                    <?php } else { ?>
                                            <?php echo get_sub_field('sponsor_name');?>
                                    <?php } ?>
                                    <?php if($sponsor_url) {?>
                                        </a>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            </div>
                           
			<?Php
				endwhile;
			?>
           				</div>
					</div>
					<a class="btn-prev" href="#"><i class="icon-left-open"></i></a>
					<a class="btn-next" href="#"><i class="icon-right-open"></i></a>
				</div>
			</section>
            <?php	
			endif;
			
			?>
		</div>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>

<?php get_footer(); ?>