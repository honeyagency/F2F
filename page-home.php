<?php
/*
Template Name: Home
 */

?>

<?php get_header();?>

<body>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
<?php

get_template_part('partials/page-header');
$header_images = get_field('header_images');
// Supply a user id and an access token
// $userid      = "1372446873";
// $clientid    = '34499fdd7c6c482e87af3657cbd67290';
// $accessToken = "27486739.3a81a9f.5dc5c80a659e488bb032d8ddc08f917e";

// // Gets our data
// function fetchData($url)
// {
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
//     $result = curl_exec($ch);
//     curl_close($ch);
//     return $result;
// }

// // Pulls and parses data.
// $result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}&count=8");
// //$result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?client_id={$clientid}&count=8");
// $result = objectToArray(json_decode($result));

// print_r($instagramCachedResults);

// foreach ($instagramCachedResults as &$data) {

//     $width = $data['images']['low_resolution']['width'];

//     $height = $data['images']['low_resolution']['height'];

//     $ratio = $width / $height;
//     // print_r($ratio);
//     $newArray = array();
//     if ($ratio < 1) {
//         $newArray = 'tall';
//     } else {
//         $newArray = 'wide';
//     }
//     $data['aspect'] = $newArray;
// }

?>

		<img src="<?php echo the_post_thumbnail_url(); ?>">
<br><br>


        <?php if ($upcoming_events_intro = get_field('upcoming_events_intro')): ?>
        <div class="container">
        	<a name="events" style="margin-top:-120px; position:absolute;"></a>
        <?php
echo $upcoming_events_intro;
?>
        </div>
        <?php
endif;
?>
<?php
	get_template_part('partials/components/component--home-events');
	// get_template_part('partials/components/component--home-upcoming');
?>
		<!-- article in the page -->
        <?php

$featured_blog_post = get_field('featured_blog_post');

if ($featured_blog_post):

    // override $post
    $post = $featured_blog_post;
    setup_postdata($post);

    ?>

						                <article class="article alignright">
						                	<?php if (has_post_thumbnail(get_the_ID())) {?>
						                    <div class="image">
						                        <div class="img-holder">
						                            <?php echo get_the_post_thumbnail(get_the_ID(), 'medium', array('alt' => '')); ?>
						                        </div>
						                    </div>
						                    <?php }?>

						                    <!-- article detail -->

						                    <div class="detail">
						                        <div class="detail-holder">
						                            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
						                            <time datetime="<?php echo get_the_date('Y-m-d', get_the_ID()); ?>"><?php echo get_the_date('F j, Y', get_the_ID()); ?></time>
						                            <p><?php echo get_excerpt_by_id(get_the_ID(), '', 1); ?></p>
						                            <ul class="more-links">
						                                <li><a href="<?php the_permalink();?>">Read More</a></li>
						                                <li><a href="/dig-in-blog/">Dig In Blog</a></li>
						                            </ul>
						                        </div>
						                    </div>
						                </article>

										<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

								<?php endif;?>

		<!-- featured area -->
		<section class="container featured-area">
			<div class="featured-box">
				<h2><span>FEATURED</span> Foodie Hero</h2>
				<!-- feature slideshow -->
				<div class="feature-slideshow">
					<div class="slideset">
                    <?php

// check if the repeater field has rows of data
if (have_rows('food_heroes')):

    // loop through the rows of data
    while (have_rows('food_heroes')): the_row();
        ?>
																			<div class="slide">
																			<div class="img-holder">
												                            	<?php $hero_image = get_sub_field('image');?>
												                                <?php if ($hero_url = get_sub_field('url')) {?>
												                                <a href="<?php echo $hero_url; ?>" target="_blank">
																				<?php }?>
												                                <img src="<?php echo $hero_image['url']; ?>" height="250" width="300" alt="<?php the_sub_field('name');?>">
												                                <?php if ($hero_url = get_sub_field('url')) {?>
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
if (have_rows('partners')):

    $count = 1;

    // loop through the rows of data
    while (have_rows('partners')): the_row();
        ?>
																				<div class="slide-holder">
																					<div class="logo-holder">
																						<div class="logo-frame">
												                                        <?php $partner_logo = get_sub_field('logo');?>
																						<?php if ($partner_url = get_sub_field('url')) {?>
												                                            <a href="<?php echo $partner_url; ?>" target="_blank">
												                                        <?php }?>
																								<img src="<?php echo $partner_logo['url']; ?>" alt="<?php the_sub_field('name');?>">
																						<?php if ($partner_url) {?>
												                                            </a>
												                                        <?php }?>
																						</div>
																					</div>
																				</div>
																		<?php

        if ($count == 2) {

            echo '</div><div class="slide">';
            $count = 0;

        }

        $count++;

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
		<?php get_template_part('partials/page-footer');?>
	</div>

<?php get_footer();?>