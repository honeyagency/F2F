<?php
/*
Template Name: Single Event
*/
?>

<?php get_header(); ?>

<body>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php get_template_part( 'partials/page-header'); ?>
		<div class="container">
			<!-- breadcrumbs -->
			<?php 
			$news_bread = '';
			if(get_post_type() == 'event') { $news_bread = '<li><a href="/events/">Events</a></li><li><a href="/events/regional-events/">Regional Events</a></li>'; }
			echo get_breadcrumbs( $post, array( 'before_all' => '<ul class="breadcrumb"><li><a href="/">Home</a></li>' . $news_bread, 'after_all' => '</ul>', 'before_each' => '<li>', 'after_each' => '</li>', 'separator' => '' ) );
			?>
			<!-- three columns -->
			<div class="three-columns">
				<!-- content block -->
				<div class="content-block">
					<aside class="event-detail">
						<div class="date-title">
							<div class="date">
                            <?php $date = DateTime::createFromFormat('Ymd', get_field('date')); ?>
								<time datetime="<?php echo $date->format('Y-m-d');?>">
									<?php echo $date->format('M');?>
									<span><?php echo $date->format('d');?></span>
								</time>
							</div>
						</div>
						<div class="detail-holder">
							<h2>Event Details</h2>
							<?php if ($eventTicketInfo = get_field('eventTicketInfo')) {?>
                                    <strong>Admission Info:</strong>
                                    <? echo $eventTicketInfo;?>
                                    <?php }?>
                                    <strong class="subtitle">General Day and Time Info:</strong>
                                    <?php if ($eventStartTime = get_field('eventStartTime')) {?>
                                        <? echo $eventStartTime;?>
                                    <?php }?>
                                    <?php if ($time = get_field('time')) {?>
                                        <? echo $time;?>
                                    <?php }?>
                                    <?php if ($end_time = get_field('end_time')) {?>
                                        <? echo ' - ' . $end_time;?>
                                    <?php }?>
                                    
                                    <strong>Address:</strong>
                                    <p>
										<?php if($venueName = get_Field('venueName')) echo $venueName . '<br>';?>
                                        <?php the_field('venueAddress1');?><br>
                                        <?php the_field('venueCity');?>, <?php the_field('venueState');?> <?php the_field('venueZip');?>
                                    </p>
									<?php 
									
									$email = get_field('eventEmail');
									$eventPhone1 = get_field('eventPhone1');
									$eventPhone2 = get_field('eventPhone2');
									
									if($email || $eventPhone1 || $eventPhone2) {?>
                                    <strong>CONTACT:</strong>
                                    <p>
                                    <?php if($email) {?>
                                        <a class="website" href="mailto: <?php echo $email;?>">Email</a><br>
                                    <?php }?>
                                    <?php if($eventPhone1) {?>
                                        <a class="tel" href="tel:<?php echo $eventPhone1;?>"><?php echo $eventPhone1;?></a><br>
                                    <?php }?>
                                     <?php if($eventPhone2) {?>
                                        <a class="tel" href="tel:<?php echo $eventPhone2;?>"><?php echo $eventPhone2;?></a>
                                    <?php }?>
                                    </p>
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
								<strong class="title">PRESENTED BY</strong>
								<div class="lexus-logo">
									<img src="<?php echo $organization_logo['url'];?>" width="222" alt="">
								</div>
							</div>
                            <?php }?>
						</div>
					</aside>
					<!-- main content part -->
					<section class="content">
						<div class="content-box">
							<div class="date-title">
								<div class="date">
									<time datetime="<?php echo $date->format('Y-m-d');?>">
										<?php echo $date->format('M');?>
										<span><?php echo $date->format('d');?></span>
									</time>
								</div>
							</div>
							<div class="content-holder">
								<h1><?php the_title();?></h1>
                                <?php if($organization_name = get_Field('organization_name')) {?>
								<span class="sub-heading">Presented by <?php echo $organization_name;?></span>
                                <?php } ?>
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php $content = get_the_content();?>
                                <?php if($content) {
                                            echo $content;
                                      } else {
                                            the_field('eventDescription');
                                      }
                                ?>
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
                        <strong class="title">PRESENTED BY</strong>
                        <div class="lexus-logo">
                            <img src="<?php echo $organization_logo['url'];?>" width="222" alt="">
                        </div>
                    </div>
                    <?php }?>
				</aside>
			</div>
		</div>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>
    
    
<?php get_footer(); ?>