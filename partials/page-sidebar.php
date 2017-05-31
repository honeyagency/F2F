				<aside id="sidebar">
                    <?php if(get_post_type() == 'post' || is_page('dig-in-blog')) { ?>
                    <div class="widget">
						<div class="categories-list">
							<h2><a href="#" class="categories-opener"><span>Categories</span></a></h2>
							<div class="categories-slide">
								<ul class="side-nav">
									<?php $categories = get_terms( 'category' ); ?>
									<?php if($categories) { ?>
                                    <?php foreach ($categories as $category) {?>  
                                    <li><a href ="<?php echo get_term_link($category);?>"><?php echo $category->name;?></a></li>
                                        <?php }?>
                                    <?php }?>
								</ul>
							</div>
						</div>
                        <p>Get Farm-to-Fork in your inbox</p>
                        <a href="/contact/newsletter-opt-in/" class="btn-default">Email Sign-Up</a>
                    </div>
                    <?php } elseif(get_post_type() == 'page') { ?>
                    
                    <?php

						if ($post->post_parent)	{
							$ancestors=get_post_ancestors($post->ID);
							$root=count($ancestors)-1;
							
							if($root > 1) { $root = 1; } // only go 2 levels
							
							$parent = $ancestors[$root];
							
						} else {
							$parent = $post->ID;
						}
				  
						$children = wp_list_pages(array('title_li' => '',
														 'child_of' => $parent,
														 'depth' => 1,
														 'echo' => 0));
							  
						if ($children) { ?>
                       	<div class="widget">
							<div class="categories-list">
							<h2><a href="<?php echo get_permalink($parent);?>" class="categories-opener"><span><?php echo get_the_title($parent);?></span></a></h2>
                                <div class="categories-slide">
                                    <ul class="side-nav">
                                        <?php echo $children; ?>
                                    </ul>
                                </div>
                            </div>
                            <p>Get Farm-to-Fork in your inbox</p>
                            <a href="/contact/newsletter-opt-in/" class="btn-default">Email Sign-Up</a>
                        </div>    
						<?php } ?>

                    <?php } else { ?>
                    <div class="widget">
                    	<p>Get Farm-to-Fork in your inbox</p>
						<a href="/contact/newsletter-opt-in/" class="btn-default">Email Sign-Up</a>
					</div>
                    <?php } ?>
					<!-- featured box -->
					<div class="featured-box">
						<h2><span>FEATURED</span> Foodie Hero</h2>
						<div class="feature-slideshow">
							<div class="slideset">
								<?php

								// check if the repeater field has rows of data
								if( have_rows('food_heroes', 82) ):
								
									// loop through the rows of data
									while ( have_rows('food_heroes', 82) ) : the_row();
								?>
										<div class="slide">
										<div class="img-holder">	
											<?php $hero_image = get_sub_field('image');?>
											<?php if($hero_url = get_sub_field('url')) {?>
											<a href="<?php echo $hero_url;?>" target="_blank">
											<?php }?>
											<img src="<?php echo $hero_image['url'];?>" height="250" width="300" alt="<?php the_sub_field('name');?>">
											<?php if($hero_url = get_sub_field('url')) {?>
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
						<ul class="more-links">
							<li><a href="/join-and-support/partnership-opportunities/">Learn More about becoming a Partner</a></li>
						</ul>
					</div>
				</aside>