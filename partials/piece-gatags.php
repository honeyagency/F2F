		<header id="header">
			<div class="container">
				<div class="head">
					<a href="#" class="btn-back">Back</a>
					<a href="#" class="cancel"><i class="icon-cancel"></i></a>
				</div>
				<!-- logo of the page -->
				<h1 class="logo">
					<a href="/">America's farm-to-fork capital sacramento, ca</a>
				</h1>
				<!-- main navigation in the page -->
				<nav class="nav-area">
					<a href="#" class="opener"><em></em><span class="menu">Menu</span><span class="close">Close</span></a>
					<!-- navigation dropdown -->
					<div class="dropdown">
						<div class="drop-holder win-height">
							<div class="container">
								<div class="row-holder">
									<div class="row">
										<div class="col">
											<div class="widget">
												<div class="image-holder">
													<div class="image-frame"><img src="<?php bloginfo('template_url'); ?>/images/img22.png" height="165" width="220" alt=""></div>
												</div>
												<h2><a href="/what-we-do/" class="open">What We Do</a></h2>
												<div class="links-drop win-height">
													<div class="links-holder">
														<h2>What We Do</h2>
														<ul>
															<?php wp_list_pages("title_li=&child_of=6&depth=1");?>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="widget">
												<div class="image-holder">
													<div class="image-frame">
														<img src="<?php bloginfo('template_url'); ?>/images/img23.png" height="165" width="220" alt="">
													</div>
												</div>
												<h2><a href="/taste-and-tour/" class="open">Taste &amp; Tour</a></h2>
												<div class="links-drop win-height">
													<div class="links-holder">
														<h2>Taste &amp; Tour</h2>
														<ul>
															<?php wp_list_pages("title_li=&child_of=8&depth=1");?>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="widget">
												<div class="image-holder">
													<div class="image-frame">
														<img src="<?php bloginfo('template_url'); ?>/images/img24.png" height="165" width="220" alt="">
													</div>
												</div>
												<h2><a href="/events/" class="open">Events</a></h2>
												<div class="links-drop win-height">
													<div class="links-holder">
														<h2>Events</h2>
														<ul>
															<?php wp_list_pages("title_li=&child_of=10&depth=1");?>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="widget">
												<div class="image-holder">
													<div class="image-frame">
														<img src="<?php bloginfo('template_url'); ?>/images/img25.png" height="165" width="220" alt="">
													</div>
												</div>
												<h2><a href="/contact/" class="open">Contact</a></h2>
												<div class="links-drop win-height">
													<div class="links-holder">
														<h2>Contact</h2>
														<ul>
															<?php wp_list_pages("title_li=&child_of=16&depth=1");?>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="widget">
												<div class="image-holder">
													<div class="image-frame">
														<img src="<?php bloginfo('template_url'); ?>/images/img26.png" height="165" width="220" alt="">
													</div>
												</div>
												<h2><a href="/press-and-news/" class="open">Press &amp; News</a></h2>
												<div class="links-drop win-height">
													<div class="links-holder">
														<h2>Press &amp; News</h2>
														<ul>
															<?php wp_list_pages("title_li=&child_of=14&depth=1");?>
														</ul>
													</div>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="widget">
												<div class="image-holder">
													<div class="image-frame">
														<img src="<?php bloginfo('template_url'); ?>/images/img27.png" height="165" width="220" alt="">
													</div>
												</div>
												<h2><a href="/join-and-support/" class="open">Join &amp; Support</a></h2>
												<div class="links-drop win-height">
													<div class="links-holder">
														<h2>Join &amp; Support</h2>
														<ul>
															<?php wp_list_pages("title_li=&child_of=12&depth=1");?>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- search part in dropdown -->
								<div class="search-col">
									<div class="col-holder">
										<form action="/" class="search-form">
											<fieldset>
												<button type="submit"><i class="icon-search"></i></button>
												<div class="input-holder">
													<input type="search" placeholder="Search" name="s">
												</div>
											</fieldset>
										</form>
									</div>
                                    <?php

									// check if page has quick links
									if( have_rows('quick_links') ) {
									
									?>
                                    <div class="col-holder">
										<h3>QUICK LINKS</h3>
										<ul class="quick-search">
                                    <?php
										// loop through the rows of data
										while ( have_rows('quick_links') ) : the_row();
									
										if(get_sub_field('internal_or_external') == 'internal') {
											
											$link = get_sub_field('page_link');
											$target = '';
											
										} elseif(get_sub_field('internal_or_external') == 'external') {
										
											$link = get_sub_field('url');
											$target = ' target="_blank"';
										}
									
									?>
											<li><a href="<?php echo $link;?>"<?php echo $target;?>><?php the_sub_field('title');?></a></li>									
									<?php
										endwhile;
									?>
									
                                    	</ul>
                                   	</div>
                                    
                                    <?php } else { // if page doesn't have quick links ?>
                                    
												<?php
            
                                                // check if homepage has quick links
                                                if( have_rows('quick_links', 82) ) {
                                                
                                                ?>
                                                <div class="col-holder">
                                                    <h3>QUICK LINKS</h3>
                                                    <ul class="quick-search">
                                                <?php
                                                    // loop through the rows of data
                                                    while ( have_rows('quick_links', 82) ) : the_row();
                                                
                                                    if(get_sub_field('internal_or_external') == 'internal') {
                                                        
                                                        $link = get_sub_field('page_link');
                                                        $target = '';
                                                        
                                                    } elseif(get_sub_field('internal_or_external') == 'external') {
                                                    
                                                        $link = get_sub_field('url');
                                                        $target = ' target="_blank"';
                                                    }
                                                
                                                ?>
                                                        <li><a href="<?php echo $link;?>"<?php echo $target;?>><?php the_sub_field('title');?></a></li>									
                                                <?php
                                                    endwhile;
                                                ?>
                                                
                                                    </ul>
                                                </div>
                                                
                                                <?php
                                                
                                                }
										}
									
									?>
									<div class="col-holder">
										<ul class="socials-list">
											<li>
												<a href="https://www.facebook.com/FarmToForkCapital" target="_blank"><i class="icon-facebook-squared"></i></a>
											</li>
											<li>
												<a href="https://twitter.com/sacfarm2fork" target="_blank"><i class="icon-twitter"></i></a>
											</li>
											<li>
												<a href="https://instagram.com/sacfarm2fork/" target="_blank"><i class="icon-instagramm"></i></a>
											</li>
											<li>
												<a href="https://www.pinterest.com/VisitSacramento/" target="_blank"><i class="icon-pinterest-squared"></i></a>
											</li>
											<li>
												<a href="https://www.youtube.com/user/discovergold" target="_blank"><i class="icon-youtube"></i></a>
											</li>
											<li>
												<a href="mailto:info@farmtoforkcapital.com"><i class="icon-mail-alt"></i></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</nav>
				<!-- blocg link page -->
				<a href="/dig-in-blog/" class="blog-link">
					<span class="dig-in">Dig in</span>
					<strong>Blog</strong>
				</a>
			</div>
		</header>