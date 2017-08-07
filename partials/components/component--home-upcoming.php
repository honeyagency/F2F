<div class="slideshow container">
			<div class="pagination-box">
				<h2>UPCOMING EVENTS</h2>
				<div class="pagination-holder">
					<div class="pagination">
						<ul>
                        <?php foreach ($upcoming_events as $event) {?>
							<li>
                            <?php if ($event['date']): $date = DateTime::createFromFormat('Ymd', $event['date']);endif;?>
								<a href="<?php echo $event['permalink']; ?>">
									<?php if ($event['date']): ?><time datetime="<?php echo $date->format('Y-m-d'); ?>"><?php echo $date->format('M d'); ?></time><?php endif;?>
									<strong><?php echo $event['name']; ?></strong>
								</a>
							</li>
                        <?php }?>
						</ul>
					</div>
					<a href="/events/" class="more-events">More Events</a>
				</div>
			</div>
			<div class="slide-holder">
				<div class="slideset">
                <?php foreach ($upcoming_events as $event) {
    ?>
					<section class="slide">
						<div class="img-holder<?php if (!$homepage_image = $event['homepage_image']) {?> img-empty<?php }?>">
                        <?php if ($homepage_image) {?>
							<a href="<?php echo $event['permalink']; ?>">
								<img src="<?php echo $homepage_image; ?>" width="686" alt="">
							</a>
                            <?php }
    if ($event['date']):
    ?>
							<?php $date = DateTime::createFromFormat('Ymd', $event['date']);?>
                            <div class="date">
								<time datetime="<?php echo $date->format('Y-m-d'); ?>"><?php echo $date->format('M'); ?> <span><?php echo $date->format('d'); ?></span></time>
							</div>
                            <?php
endif;
    ?>
						</div>
						<div class="detail">
							<h1><a href="<?php echo $event['permalink']; ?>"><?php echo $event['name']; ?></a></h1>
							<?php $terms = get_the_terms($event['id'], 'event_categories');?>
							<span class="sub-title"><?php echo $terms[key($terms)]->name; ?></span>
							<p><?php echo $event['description']; ?></p>
							<ul class="more-links">
								<li><a href="<?php echo $event['permalink']; ?>" class="btn-default">Read More</a></li>
                                <?php if ($event['eventTicketUrl']): ?>
                                <li><a href="<?php echo $event['eventTicketUrl']; ?>" target="_blank" class="btn-default">Tickets</a></li>
                                <?php endif;?>
							</ul>
						</div>
					</section>
                <?php }?>
				</div>
			</div>
			<a class="btn-prev" href="#"><i class="icon-left-open"></i></a>
			<a class="btn-next" href="#"><i class="icon-right-open"></i></a>
		</div>