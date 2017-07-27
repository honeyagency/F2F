<?php
/*
Template Name: Archive Events
*/
?>

<?php get_header(); ?>

<?php
															
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				
				$category = get_query_var('category');
								
				$startVar = explode("/", get_query_var('start'));
				$start = $startVar[2] . $startVar[0] . $startVar[1];
				
				if(!$start) {
					$start = date('Ymd');
				}
				
				$endVar = explode("/", get_query_var('end'));
				$end = $endVar[2] . $endVar[0] . $endVar[1];
				
				$search = get_query_var('search');
								
				$args['pagination'] = 'true';
				$args['posts_per_page'] = '12';
				$args['paged'] = $paged;
				$args['post_type'] = 'event';
				$args['orderby'] = 'meta_value';
				$args['meta_key'] = 'date';
				$args['order'] = 'ASC';
				
				
				if($category || $start || $end || $search) {
					
					// Search
			
					if($search) {
						$args['s'] = $search;
					}
					
					if($category) {
						
						$args['tax_query'] = array('relation' => 'AND');
						
						// category
				
						if($category) {
						
						$args['tax_query'][0] = array(
												'taxonomy' => 'event_categories',
												'field' => 'slug',
												'terms' => $category
											); 					
						}

					}
					
					
					// Skip blank dates
					
					$args['meta_query'][0] = array(
											'key' => 'date',
											'compare' => '!=',
											'value' => ''
											);
					
					
					// start date
				
					if($start) {
					
					$args['meta_query'][1] = array(
											'key' => 'date',
											'compare' => '>=',
											'value' => $start
										); 					
					}
					
					
					// end date
			
					if($end) {
					
					$args['meta_query'][2] = array(
											'key' => 'date',
											'compare' => '<=',
											'value' => $end
										); 					
					}
					
					
				}
				
				// The Query
				$query = new WP_Query( $args );
				
				// The Loop
				if ( $query->have_posts() ) {

					while ( $query->have_posts() ) {
						$query->the_post();
						// do something
						
						$events[] = array('id' => get_the_id(),
											'name' => get_the_title(),
											'date' => get_field('date'),
											'permalink' => get_permalink(),
											'venueName' => get_field('venueName'),
											'venueAddress1' => get_field('venueAddress1'),
											'venueCity' => get_field('venueCity'),
											'description' => get_excerpt_by_id(get_the_id(), '', 'nolink'),
											'eventImage' => get_field('eventImage'),
											'time' => get_field('time'),
											'end_time' => get_field('end_time')
											);
					}
					?>
					
			  <?php
				$big = 999999999; // need an unlikely integer
				
				$pagination = paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $query->max_num_pages,
					'type' => 'plain'
				) );
				
				$next_posts_link = get_next_posts_link('Next', $query->max_num_pages);
				
				$previous_posts_link = get_previous_posts_link('Previous');
				
				$results_total = $query->max_num_pages * $args['posts_per_page'] - ($args['posts_per_page'] - $query->post_count);
				$results_showing = $args['posts_per_page'] * $paged - $args['posts_per_page'] + 1;
				$results_showing .= '-';
				$results_showing .= $args['posts_per_page'] * $paged - ($args['posts_per_page'] - $query->post_count);
				
				?>
				<?php
					
				} else {
					// no posts found
				}
				?>
			 
			  <?php  
				// Restore original Post Data
				wp_reset_postdata();
				?>
                

<body>
<!-- google tag manager -->
	<?php get_template_part( 'partials/piece-gatags'); ?>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php get_template_part( 'partials/page-header'); ?>
		<!-- promo section -->
		<section class="promo add">
			<div class="img-holder">
				<div class="img-frame">
					<img src="<?php bloginfo('template_url'); ?>/images/img43.jpg" height="195" width="1200" alt="">
				</div>
			</div>
			<div class="caption">
				<div class="caption-holder">
					<div class="container">
						<div class="caption-box">
							<strong>Event Calendar</strong>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="container">
			<!-- find event form -->
			<form class="find-event" action="/events/regional-events/">
				<fieldset>
					<!-- header -->
					<div class="header">
						<div class="powered-by">
							<!--<strong>Powered by</strong>-->
							<div class="sacra-logo">
								<a href="http://sacramento365.com" target="_blank">
									<img src="<?php bloginfo('template_url'); ?>/images/sacra-logo.png" height="26" width="170" alt="sacramento365.com">
								</a>
							</div>
						</div>
						<h1>Find an Event</h1>
					</div>
					<!-- form box -->
					<div class="form-box">
						<a href="#" class="filters"><span class="filter">Filters</span><span class="close">Close</span></a>
						<div class="form-holder">
							<div class="form-frame">
								<div class="row">
									<div class="col">
										<div class="sub-col">
											<div class="select-date">
												<!-- <a href="#" class="link">calendar</a> -->
												<div class="input-holder">
													<input type="text" placeholder="Start Date" class="datepicker date-from" name="start"<?php if(get_query_var('start')) { echo ' value="' . get_query_var('start') . '"';}?>>
												</div>
											</div>
										</div>
										<div class="sub-col">
											<div class="select-date">
												<!-- <a href="#" class="link end">calendar</a> -->
												<div class="input-holder">
													<input type="text" placeholder="End Date" class="datepicker date-to" name="end"<?php if(get_query_var('end')) { echo ' value="' . get_query_var('end') . '"';}?>>
												</div>
											</div>
										</div>
									</div>
									<div class="col">
										<ul class="links-list">
											<li><a href="#" id="setToday">Today</a></li>
											<li><a href="#" id="setTomorrow">Tomorrow</a></li>
											<li><a href="#" id="setWeekend">Weekend</a></li>
										</ul>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<div class="sub-col">
											<div class="search-field">
												<button type="submit"><i class="icon-search"></i></button>
												<div class="input-holder">
													<input type="search" placeholder="Keyword" name="search"<?php if(get_query_var('search')) { echo ' value="' . get_query_var('search') . '"';}?>>
												</div>
											</div>
										</div>
									</div>
									<div class="col select">
										<div class="sub-col">
											<select name="category">
												<option value=""<?php if(!get_query_var('category')) echo ' selected';?> class="hideme">ALL CATEGORIES</option>
												<?php $event_categories = get_terms( 'event_categories' ); ?>
                                                <?php if($event_categories) { ?>
                                                <?php foreach ($event_categories as $event_category) {?>  
                                                <option value="<?php echo $event_category->slug;?>"<?php if($event_category->slug == get_query_var('category')) echo ' selected';?>><?php echo $event_category->name;?></option>
                                                    <?php }?>
                                                <?php }?>
											</select>
										</div>
										<div class="sub-col">
											<input type="submit" class="btn-default" value="See Results">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a href="http://www.sacramento365.com/page/submit_event/" class="submit-event" target="_blank">Submit an Event</a>
				</fieldset>
			</form>
			<!-- two column -->
			<div class="two-column">
				<div class="post-block">
					<div class="post-holder">
                    <?php if($events) {?>
                    	<?php foreach($events as $event) {?>
						<article class="blog-post">
							<div class="date-title">
								<div class="date">
                                <?php $date = DateTime::createFromFormat('Ymd', $event['date']); ?>
									<time datetime="<?php echo $date->format('Y-m-d');?>">
										<?php echo $date->format('M');?>
										<span><?php echo $date->format('d');?></span>
									</time>
								</div>
							</div>
							<div class="blog-holder">
                            	<?php if($event['eventImage']) {?>
								<div class="image">
                                	<?php $eventImage = $event['eventImage'];?>
									<a href="<?php echo $event['permalink'];?>">
										<img src="<?php echo $eventImage['sizes']['thumbnail'];?>" height="131" width="131" alt="">
									</a>
								</div>
                                <?php }?>
								<div class="detail">
									<h2><a href="<?php echo $event['permalink'];?>"><?php echo $event['name'];?></a></h2>
                                    <?php $terms = get_the_terms($event['id'], 'event_categories'); ?>
									<span class="sub-title"><?php echo $terms[key($terms)]->name; ?></span>
									<p><?php echo $event['description'];?></p>
									<a href="<?php echo $event['permalink'];?>" class="more">Read More</a>
								</div>
							</div>
						</article>
                        <?php }?>
                    <?php }?>
					</div>
					<!-- paging -->
					<div class="paging">
						<div class="prev"><?php echo $previous_posts_link;?></div>
						<div class="next"><?php echo $next_posts_link;?></div>
					</div>
					<a href="#" class="back">Back to Top</a>
				</div>
				<!-- main sidebar -->
				<?php get_template_part( 'partials/page-sidebar'); ?>
			</div>
		</div>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>
    
<?php get_footer(); ?>