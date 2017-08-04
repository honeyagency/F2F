<?php
/*
Template Name: Test Quiz
*/
?>

<?php get_header(); ?>


<body>

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
					<img src="images/img35.jpg" height="399" width="598" alt="image description">
				</div>
			</div>
			<div class="detail">
				<div class="detail-holder">
					<form action="#" class="search-market">
						<fieldset>
							<h2>Find a Farmers’ Market Near You</h2>
							<div class="select-holder">
								<select>
									<option>Select Region</option>
									<option>Sacramento</option>
									<option>Yolo</option>
									<option>Placer</option>
									<option>Amador</option>
									<option>Dolor Ipsom County</option>
								</select>
							</div>
							<div class="select-holder">
								<select>
									<option>Select Day</option>
									<option>Monday</option>
									<option>Tuesday</option>
									<option>Wednesday</option>
									<option>Thursday</option>
									<option>Friday</option>
									<option>Saturday</option>
									<option>Sunday</option>
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
					<div class="day">
						<h3>Tuesdays</h3>
						<ul>
							<li>
								<strong class="title"><a href="#">Certified Farmers Market</a></strong>
								<address>9th and P Streets at Roosevelt Park</address>
								<time datetime="2015-05-05">10:00am-1:30pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">Woodland Certified Farmer’s Market</a></strong>
								<address>Woodland Memorial Hospital, 1325 Cottonwood Ave.</address>
								<time datetime="2015-05-05">4:00pm-7:00pm</time>
							</li>
						</ul>
					</div>
					<div class="day">
						<h3>Wednesdays</h3>
						<ul>
							<li>
								<strong class="title"><a href="#">BMSUSA Sunrise Mall Farmers Market</a></strong>
								<address>Sunrise Mall, 6196 Sunrise Mall, Citrus Heights, CA</address>
								<time datetime="2015-05-05">8:00am-1:00pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">Davis Farmers Market</a></strong>
								<address>Central Park, 3rd &amp; C Streets</address>
								<time datetime="2015-05-05">4:30am-8:30pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">BMSUSA Sunrise Mall Farmers Market</a></strong>
								<address>Sunrise Mall, 6196 Sunrise Mall, Citrus Heights, CA</address>
								<time datetime="2015-05-05">8:00am-1:00pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">Davis Farmers Market</a></strong>
								<span class="month">May-October</span>
								<address>Central Park, 3rd &amp; C Streets</address>
								<time datetime="2015-05-05">4:30am-8:30pm</time>
							</li>
						</ul>
					</div>
					<div class="day">
						<h3>Thursdays</h3>
						<ul>
							<li>
								<strong class="title"><a href="#">BMSUSA Sunrise Mall Farmers Market</a></strong>
								<address>Sunrise Mall, 6196 Sunrise Mall, Citrus Heights, CA</address>
								<time datetime="2015-05-05">8:00am-1:00pm</time>
							</li>
						</ul>
					</div>
				</div>
				<div class="col">
					<h2>Weekends</h2>
					<div class="day">
						<h3>Saturdays</h3>
						<ul>
							<li>
								<strong class="title"><a href="#">BMSUSA Sunrise Mall Farmers Market</a></strong>
								<address>Sunrise Mall, 6196 Sunrise Mall, Citrus Heights, CA</address>
								<time datetime="2015-05-05">8:00am-1:00pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">Certified Farmers’ Market</a></strong>
								<address>Folsom and Sunrise Blvd. at Sunrise Station</address>
								<time datetime="2015-05-05">8:00am-12:00pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">Certified Farmers’ Market</a></strong>
								<address>Watt and El Camino at Country Club Plaza</address>
								<time datetime="2015-05-05">8:00am-1:00pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">BMSUSA Sunrise Mall Farmers Market</a></strong>
								<address>3637 N. Freeway Blvd. at the Promenade</address>
								<time datetime="2015-05-05">8:00am-1:00pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">BMSUSA Sunrise Mall Farmers Market</a></strong>
								<address>Laguna and Big Horn Blvds. at the Laguna Gateway Center</address>
								<time datetime="2015-05-05">8:00am-1:00pm</time>
							</li>
						</ul>
					</div>
					<div class="day">
						<h3>Sundays</h3>
						<ul>
							<li>
								<strong class="title"><a href="#">BMSUSA Sunrise Mall Farmers Market</a></strong>
								<address>Sunrise Mall, 6196 Sunrise Mall, Citrus Heights, CA</address>
								<time datetime="2015-05-05">8:00am-1:00pm</time>
							</li>
							<li>
								<strong class="title"><a href="#">Certified Farmers’ Market</a></strong>
								<address>Folsom and Sunrise Blvd. at Sunrise Station</address>
								<time datetime="2015-05-05">8:00am-12:00pm</time>
							</li>
						</ul>
					</div>
				</div>
			</section>
			<aside id="sidebar">
            	<div class="widget">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                       	<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
                        <?php endwhile; else: ?>
                        	<p>Sorry, no content.</p>
                        <?php endif; ?>
                </div>
            </aside>
		</div>
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>
    
<?php get_footer(); ?>