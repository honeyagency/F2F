<?php
/*
Template Name: Newsletter Thank You
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
		<!-- two columns -->
		<div class="two-columns">
			<div class="container">
				<!-- main content part -->
				<section id="content">
					<div class="content-holder">
						<!-- breadcrumbs -->
					 <?php 
                        $news_bread = '';
                        echo get_breadcrumbs( $post, array( 'before_all' => '<ul class="breadcrumb"><li><a href="/">Home</a></li>' . $news_bread, 'after_all' => '</ul>', 'before_each' => '<li>', 'after_each' => '</li>', 'separator' => '' ) );
                        ?>
						<?php
						// Create JSON to send to dmplocal

						$skey = 'f3c5ba7f422ecc95a452fa2c5421b24896f4ff1f';
						$operator_email = 'jnussbaum@visitsacramento.com';
						$owner_email = 'jnussbaum@visitsacramento.com';
						$api_id = 'visitsacramento';
						
						$first_name = $_GET['first'];
						$last_name = $_GET['last'];
						$email = $_GET['email'];
						$groups = array('F2F Dig In Consumer Newsletter');
						
						if($email) {
						
							$vars = array('skey' => $skey,
											'operator_email' => $operator_email,
											'api_id' => $api_id,
											'contact_group_names' => $groups,
											'contacts' => array(array('email' => $email,
																'first_name' => $first_name,
																'last_name' => $last_name,
																'owner_email' => $owner_email
																)
																),
											'return_fields' => array('id',
																	'email'
																	)
										);
										
										
							$vars = json_encode($vars, JSON_FORCE_OBJECT);
							
							$url = 'https://visitsacramento.dmplocal.com/api/Contact/Update.json';
							
							$ch = curl_init( $url );
							curl_setopt( $ch, CURLOPT_POST, 1);
							curl_setopt( $ch, CURLOPT_POSTFIELDS, $vars);
							curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
							curl_setopt( $ch, CURLOPT_HEADER, 0);
							curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
							
							$response = json_decode(curl_exec( $ch ));
							$response = $response->Valid;
							
							if($response[0]->email == $email) { echo '<h1>' . get_the_title() . '</h1>' . get_the_content(); } else { echo '<h1>There was an error</h1><p>There was an error submitting your information. Please <a href="/contact/newsletter-opt-in/">go back</a> and try again.</p>'; }
							
						} else {
							
							echo '<h1>There was an error</h1><p>There was an error submitting your information. Please <a href="/contact/newsletter-opt-in/">go back</a> and try again.</p>';
						
						}
						
						?>
                        
					</div>
					<!-- socials block -->
                    <?php get_template_part( 'partials/page-share'); ?>
				</section>
				<!-- main sidebar part -->
                <?php get_template_part( 'partials/page-sidebar'); ?>
			</div>
		</div>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>

<?php get_footer(); ?>