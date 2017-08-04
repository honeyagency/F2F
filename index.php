<?php
/*
Template Name: Archive
*/
?>

<?php get_header(); ?>

<body>

	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- header of the page -->
		<?php get_template_part( 'partials/page-header'); ?>
		<!-- promo section -->
		<section class="promo">
			<div class="img-holder">
				<div class="img-frame">
					<img src="<?php bloginfo('template_url'); ?>/images/img29.jpg" height="195" width="1200" alt="image description">
				</div>
			</div>
			<!-- promo caption -->
			<div class="caption">
				<div class="caption-holder">
					<div class="container">
						<div class="caption-box">
							<strong>Dig In Blog</strong>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- block section -->
		<div class="block">
        	<?php if ( have_posts() ) :
			
					if ( is_day() ) :
						$archive_type .= get_the_date();
					elseif ( is_month() ) :
						$archive_type .=  get_the_date( _x( 'F Y') );
					elseif ( is_year() ) :
						$archive_type .=  get_the_date( _x( 'Y' ) );
					else :
						$archive_type .= 'Archives';
					endif;
            
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
								
					echo '<div class="news"><p>Sorry no results found.</p><p><a href="/news/" class="readmore">View all news</a></p></div>';
								
				endif; ?>
    
    
   	<?php 	
	
			if($articles && (!$paged || $paged == 1)) {
				
	?>			
    			<article class="article alignright add">
                    <div class="image">
                    	<?php if ( has_post_thumbnail($articles[0]['id']) ) { ?>
                        <div class="img-holder">
                            <a href="<?php echo $articles[0]['permalink']; ?>"><?php echo get_the_post_thumbnail($articles[0]['id'], 'medium', array('alt' => ''));?></a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="detail">
                        <div class="detail-holder">
                            <h2><?php echo $articles[0]['title'];?></h2>
                            <time datetime="<?php echo get_the_date('Y-m-d', $articles[0]['id']); ?>"><?php echo get_the_date('F j, Y', $articles[0]['id']); ?></time>
                            <?php echo get_excerpt_by_id($articles[0]['id'], '', 1);?>
                            <ul class="more-links">
                                <li><a href="<?php echo $articles[0]['permalink'];?>">Read More</a></li>
                            </ul>
                        </div>
                    </div>
                </article>
	<?php
    		}
	?>
			<!-- two columns -->
			<div class="twocolumns container">
				<!-- article block -->
				<div class="article-block">
					<div class="article-holder">
    <?php
			$i = 0; 
	
			foreach($articles as $article) {
	
				if($i > 0) {?>

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
				
				$i++;
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