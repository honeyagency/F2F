<?php
function homepageEvents()
{
    $posts           = get_field('field_558b168a98f48');
    $upcoming_events = array();

    foreach ($posts as $post) {

        // setup_postdata($post);
        if (get_field('homepage_image')) {
            $homepage_image = get_field('homepage_image', $post->ID);
            $homepage_image = wp_get_attachment_image_src($homepage_image, 'home_event_image', true);
            $homepage_image = $homepage_image[0];
        } else {
            $thumb_id        = get_post_thumbnail_id($post->ID);
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'home_event_image', true);
            $homepage_image  = $thumb_url_array[0];
        }
        $date              = date(get_field('date', $post->ID));
        $upcoming_events[] = array(
            'id'             => $post->ID,
            'name'           => get_the_title($post->ID),
            'date'           => $date,
            'permalink'      => get_permalink($post->ID),
            'description'    => get_excerpt_by_id($post->ID, '', 'nolink', 30),
            'homepage_image' => $homepage_image,
            'eventTicketUrl' => get_field('eventTicketUrl', $post->ID),
        );
    }

    return $upcoming_events;

}
$homeEvents = homepageEvents();
?>
<section class="container clear">

<div class="row">

    <?php
    foreach ($homeEvents as $event) {
        ?>
    <div class="col grid--sm-third grid-item block--singe--event" id="event-<?php echo $event['id']; ?>">
    	<a href="<?php echo $event['permalink']; ?>"><img src="<?php echo $event['homepage_image']; ?>" width="" alt="<?php echo $event['name']; ?>"></a>
    	<a href="<?php echo $event['permalink']; ?>"><time class="color--gold"><?php $date = date_create($event['date']); echo date_format($date, "M d");?></time></a>
    	<a href="<?php echo $event['permalink']; ?>"><h2 class="color--black"><?php echo $event['name']; ?></h2></a>
    	<?php echo $event['description']; ?>
    	<a href="<?php echo $event['permalink']; ?>">Read More</a>
<?php 
if ($event['eventTicketUrl'] != null) {
    echo ' | <a href="' . $event['eventTicketUrl'] . '">Tickets</a>';
}?>
        
    </div>
    <?php
    }?>
    <div class="grid--one nog clear">
    <a href="/events/" class="btn-default">View All Events</a>
    </div>
    <br><br><br>
</div>

</section>

<br>