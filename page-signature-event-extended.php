<?php
/*
Template Name: Signature Event (extended)
*/
?>

<?php get_header(); ?>


<body class="extended page-<?php echo get_the_ID(); ?>" id="<?php echo get_the_ID(); ?>">

	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php get_template_part( 'partials/page-header'); ?>
		<!-- visual section -->
        <?php if($header_images = get_field('header_images')) {?>
        <section class="visual add landing">
			<div class="img-holder">
				<div class="img-frame">
  					<img src="<?php echo $header_images[0]['url'];?>" height="320" width="320" alt=""><img src="<?php echo $header_images[1]['url'];?>" height="320" width="360" alt="" class="mobile"><img src="<?php echo $header_images[2]['url'];?>" height="320" width="320" alt="">
				</div>
			</div>
			<div class="caption">
				<div class="caption-holder">
					<div class="container">
						<div class="caption-box">
							<div class="box-holder">
								<strong class="title"><?php the_title();?></strong>
                                <?php if($eventTicketUrl = get_field('eventTicketUrl')) {?>
                                    <a href="<?php echo $eventTicketUrl;?>" target="_blank" class="more">Tickets</a>
                                    <?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        
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
                    <?php if($date = get_field('date')){ ?>
						<div class="date-title">
							<div class="date">
                            <?php $date = DateTime::createFromFormat('Ymd', $date); ?>
								<time datetime="<?php echo $date->format('Y-m-d');?>">
									<?php echo $date->format('M');?>
									<span><?php echo $date->format('d');?></span>
								</time>
							</div>
						</div>
                    <?php } ?>
						<div class="detail-holder">
							<h2>Event Details</h2>
							<?php

							// check if the repeater field has rows of data
							if( have_rows('event_details') ):
							?>
							<?php
								// loop through the rows of data
								while ( have_rows('event_details') ) : the_row();
							?>
								<p>
									<strong class="title"><a href="<?php the_sub_field('url');?>"><?php the_sub_field('title');?></a></strong>
								</p>
							<?php
								endwhile;
							?>
							<?php
							endif;
							?>
                            <?php if($eventTicketUrl = get_field('eventTicketUrl')) {?>
                            	<a class="btn-default" href="<?php echo $eventTicketUrl;?>" target="_blank">Tickets</a>
                            <?php }?>
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
						<?php if($date){ ?>
                            <div class="date-title">
								<div class="date">
									<time datetime="<?php echo $date->format('Y-m-d');?>">
										<?php echo $date->format('M');?>
										<span><?php echo $date->format('d');?></span>
									</time>
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
						</div>
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
            
            <section class="container featured-area">
			<div class="featured-box">
				<!-- feature slideshow -->
				<div class="feature-slideshow">
					<div class="slideset">
                    <?php

					// check if the repeater field has rows of data
					if( have_rows('ads') ):
					
						// loop through the rows of data
						while ( have_rows('ads') ) : the_row();
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
				<h2><?php the_field('sponsors_title');?></h2>
				<div class="partners-slider">
					<div class="mask">
						<div class="slideset">
                        	<div class="slide">
                        <?php

						// check if the repeater field has rows of data
						if( have_rows('sponsors') ):
						
							$sponsors = get_field('sponsors');
							shuffle($sponsors);
							
							$count = 1;
							
							// loop through the rows of data
							foreach ( $sponsors as $sponsor):
						?>
								<div class="slide-holder">
									<div class="logo-holder">
										<div class="logo-frame">
                                        <?php $sponsor_logo = $sponsor['logo'];?>
										<?php if($sponsor_url = 	$sponsor['url']) {?>
                                            <a href="<?php echo $sponsor_url;?>" target="_blank">
                                        <?php }?>
                                        <?php if($sponsor_logo) {?>
												<img src="<?php echo $sponsor_logo['url'];?>" alt="<?php echo $sponsor['sponsor_name'];?>">
                                        <?php } else { ?>
                                        		<?php echo $sponsor['sponsor_name'];?>
                                        <?php } ?>
										<?php if($sponsor_url) {?>
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
						
							endforeach;
						
						endif;
						
						?>
							</div>
						</div>
					</div>
					<a class="btn-prev" href="#"><i class="icon-left-open"></i></a>
					<a class="btn-next" href="#"><i class="icon-right-open"></i></a>
				</div>
			</div>
		</section>
        
            <?php	
			endif;
			
			?>
		</div>
        
        <div class="twocolumns container add">
			<section class="adventure-block">
            	<h2>Event Details</h2>
                <?php

				// check if the repeater field has rows of data
				if( have_rows('event_details') ):
				?>
                <ul>
                <?php
					// loop through the rows of data
					while ( have_rows('event_details') ) : the_row();
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
		</div>
        
        
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>

<?php get_footer(); ?>