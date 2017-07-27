<?php
/*
Template Name: Archive Farmers Markets
*/
?>

<?php get_header(); ?>


<?php
																			
				$region = get_query_var('region');
				$day = get_query_var('wday');
				
				$args['pagination'] = 'false';
				$args['posts_per_page'] = '-1';
				$args['post_type'] = 'market';
				$args['orderby'] = 'title';
				$args['order'] = 'ASC';
				
				if($region|| $wday) {
						
						$args['tax_query'] = array('relation' => 'AND');
						
						// region
				
						if($region) {
						
						$args['tax_query'][0] = array(
												'taxonomy' => 'region',
												'field' => 'slug',
												'terms' => $region
											); 					
						}
						
						// day
				
						if($wday) {
						
						$args['tax_query'][1] = array(
												'taxonomy' => 'day',
												'field' => 'slug',
												'terms' => $wday
											); 					
						}
											
				}
				// The Query
				$query = new WP_Query( $args );
				
				// The Loop
				if ( $query->have_posts() ) {
					
					$i = 0;
					
					while ( $query->have_posts() ) {
						$query->the_post();
						// do something
						
						$day = get_field('day_of_the_week');
						//$day_slug = $day[0]->slug;
						$day_slug = $day->slug;
						
						$markets[$day_slug][] = array('id' => get_the_id(),
											'name' => get_the_title(),
											'details' => get_field('details')
											);
						$i++;
					}
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
	<div id="wrapper">
		<?php get_template_part( 'partials/page-header'); ?>
		<section class="visual add">
			<div class="img-holder">
				<div class="img-frame">
					<img src="<?php bloginfo('template_url'); ?>/images/img34.jpg" height="343" width="1200" alt="">
				</div>
			</div>
			<div class="caption">
				<div class="caption-holder">
					<div class="container">
						<div class="caption-box">
							<div class="box-holder">
								<strong class="title">Farmers Markets</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="article alignright form">
			<div class="image">
				<div class="img-holder">
					<img src="<?php bloginfo('template_url'); ?>/images/img35.jpg" height="399" width="598" alt="">
				</div>
			</div>
			<div class="detail">
				<div class="detail-holder">
					<form action="/taste-and-tour/farmers-markets/" class="search-market">
						<fieldset>
							<h2>Find a Farmers’ Market Near You</h2>
							<div class="select-holder">
								<select name="region">
									<option value=""<?php if(!get_query_var('region')) echo ' selected';?> class="hideme">All Regions</option>
									<?php $regions = get_terms( 'region' ); ?>
                                    <?php if($regions) { ?>
                                    <?php foreach ($regions as $region) {?>  
                                    <option value="<?php echo $region->slug;?>"<?php if($region->slug == get_query_var('region')) echo ' selected';?>><?php echo $region->name;?></option>
                                        <?php }?>
                                    <?php }?>
								</select>
							</div>
							<div class="select-holder">
								<select name="wday">
									<option value=""<?php if(!get_query_var('wday')) echo ' selected';?> class="hideme">All Days</option>
									<?php $days = get_terms( 'day' ); ?>
                                    <?php if($days) { ?>
                                    <?php foreach ($days as $day) {?>  
                                    <option value="<?php echo $day->slug;?>"<?php if($day->slug == get_query_var('wday')) echo ' selected';?>><?php echo $day->name;?></option>
                                        <?php }?>
                                    <?php }?>
								</select>
							</div>
							<input type="submit" class="btn-default" value="Search">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		<div class="twocolumns container add">
			<section class="week-block">
				<div class="col">
					<h2>Weekdays</h2>
            <?php if($days) {?>
                <?php foreach ($days as $day) {?>  
                    <?php if(($day->name != 'Saturday') && ($day->name != 'Sunday')) {?>
						<?php if($markets[$day->slug]) {?>
                        <div class="day">
                            <h3><?php echo $day->name;?></h3>
                            <ul>
                            <?php foreach($markets[$day->slug] as $market) {?>
                                <li>
                                    <strong class="title"><?php echo $market['name'];?></strong>
                                    <?php echo $market['details'];?>
                                </li>
                            <?php }?>
                            </ul>
                        </div>
                        <?php }?>
                    <?php }?>
                <?php }?>
             <?php }?>
				</div>
				<div class="col">
					<h2>Weekends</h2>
             <?php if($days) {?>
             	<?php foreach ($days as $day) {?>  
                    <?php if(($day->name == 'Saturday') || ($day->name == 'Sunday')) {?>
                    	<?php if($markets[$day->slug]) {?>
                    	<div class="day">
						<h3><?php echo $day->name;?></h3>
						<ul>
							<?php foreach($markets[$day->slug] as $market) {?>
							<li>
								<strong class="title"><?php echo $market['name'];?></strong>
								<?php echo $market['details'];?>
							</li>
						<?php }?>
						</ul>
					</div>
                    	<?php }?>
                   <?php }?>
                <?php }?>
             <?php }?>
				</div>
			</section>
			<?php get_template_part( 'partials/page-sidebar'); ?>
		</div>
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>
    
<?php get_footer(); ?>