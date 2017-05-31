<?php
/*
Template Name: Search
*/
?>

<?php get_header(); ?>

<body>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php get_template_part( 'partials/page-header'); ?>
		
		<!-- block section -->
		<div class="block">
        	<?php if ( have_posts() ) :
            
					/* The loop */ 
				
                	$paged = get_query_var('paged');
                
            		while ( have_posts() ) : the_post();
    
						$articles[] = array('id' => get_the_ID(),
											'permalink' => get_permalink(),
											'title' => get_the_title(),
											);
											
						$i++;
					
					endwhile;
					
					$big = 999999999; // need an unlikely integer
					
					$pagination = paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'type' => 'plain'
					) );
					
					$args['posts_per_page'] = get_option('posts_per_page');
					
					$results_total = $wp_query->found_posts;
					$results_showing = $args['posts_per_page'] * $paged - $args['posts_per_page'] + 1;
					$results_showing .= '-';
					$results_showing .= ($args['posts_per_page'] * $paged - $args['posts_per_page'] + 1) + ($i - 1);
    
    			else : 
				
				// no posts found
								
					$nothingFound = '<p>Sorry no results found.</p>';
								
				endif; ?>
   
			<!-- two columns -->
			<div class="twocolumns container">
            	<section id="content">
					<div class="content-holder">
            			<ul class="breadcrumb">
                        	<li><a href="/">Home</a></li>
                            <li>Search Results</li>
                            <li><?php echo $_GET['s'];?></li>
                        </ul>
                		<h1>Search Results</h1>
                    </div>
                </section>
				<!-- article block -->
				<div class="article-block">
					<div class="article-holder">
    <?php
			echo $nothingFound;
	
			foreach($articles as $article) {
	
				?>

						<article class="post">
							<?php if ( has_post_thumbnail($article['id']) ) { ?>
                            <div class="image">
                                <a href="<?php echo $article['permalink']; ?>"><?php echo get_the_post_thumbnail($article['id'], 'thumbnail', array('alt' => ''));?></a>
                            </div>
                            <?php } ?>
							<div class="detail">
								<h2>
                                	<?php $category = get_the_category($article['id']); ?>
									<span class="guest-post"><?php echo $category[0]->cat_name;?></span>
									<a href="<?php echo $article['permalink'];?>">
										<?php echo $article['title'];?>
									</a>
								</h2>
								<time datetime="<?php echo get_the_date('Y-m-d', $article['id']); ?>"><?php echo get_the_date('F j, Y', $article['id']); ?></time>
								<?php echo get_excerpt_by_id($article['id'], '', 1);?>
								<a href="<?php echo $article['permalink'];?>" class="more">Read More</a>
							</div>
						</article>
                        
	<?php 		
				}
	?>
	
					</div>
					<div class="paging">
                    	<?php posts_nav_link(' ','<div class="prev">Previous Page</div>','<div class="next">Next Page</div>'); ?>
					</div>
					<a href="#" class="back">Back to Top</a>
				</div>
				<!-- main sidebar part -->
				<?php get_template_part( 'partials/page-sidebar'); ?>
			</div>
		</div>
		<!-- footer of the page -->
		<?php get_template_part( 'partials/page-footer'); ?>
	</div>
    
<?php get_footer(); ?>