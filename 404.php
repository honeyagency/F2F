<?php
/*
Template Name: Base Page
*/
?>

<?php get_header(); ?>

<body>
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
					 	<ul class="breadcrumb"><li><a href="/">Home</a></li><li>Page Not Found</li></ul>
                        <h1>Not Found</h1>
                            <?php if (function_exists('wbz404_suggestions')) { wbz404_suggestions(); } ?>
					</div>
				</section>
				<!-- main sidebar part -->
                <?php get_template_part( 'partials/page-sidebar'); ?>
			</div>
		</div>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>

<?php get_footer(); ?>