<?php
/*
Template Name: Signature Event (extended)
*/
$context               = Timber::get_context();
$context['event'] = prepareExtendedSignatureEventFields();
// print_r($context);

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
                     <?php if($startDate = get_field('field_57834abc64615')){ ?>
						<div class="date-title">
							<div class="date <?php if($endDate = get_field('field_5b6204e9857d6')){echo 'end'; } ?>">
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

			Timber::render('components/sections/section--signature-event-sponsors.twig', $context);
			?>
		</div>
        
        <div class="twocolumns container add">
			<section class="adventure-block">
            	<h2 class="margin--bot-1">Event Details</h2>
                <?php

				// check if the repeater field has rows of data
				if( have_rows('event_details') ):
				?>
                <ul class="flex flex--wrap justify--between">
                <?php
					// loop through the rows of data
					while ( have_rows('event_details') ) : the_row();
				?>
                	<li class="flex flex--wrap justify--around align--items-center grid--one grid--xs-half margin--bot-2">
                    	<div class="grid--half grid--xs-fourth"><img src="<?php $image = get_sub_field('image'); echo $image['url'];?>"></div>
                    	<div class="grid--two-thirds"><strong class="title"><a href="<?php the_sub_field('url');?>"><?php the_sub_field('title');?></a></strong>
                    	<?php the_sub_field('description');?>
                    </div>
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