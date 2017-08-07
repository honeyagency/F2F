<?php

function homepageEvents()
{
    $posts = get_field('upcoming_events');
    foreach ($posts as $post) {
        setup_postdata($post);
        if (get_field('homepage_image')) {

            $homepage_image = get_field('homepage_image');
            $homepage_image = new TimberImage($homepage_image);
        } else {
            $thumb_id       = get_post_thumbnail_id(get_the_id());
            $homepage_image = new TimberImage($thumb_id);
        }
        $upcoming_events[] = array(
            'id'             => get_the_id(),
            'name'           => get_the_title(),
            'date'           => get_field('date'),
            'permalink'      => get_permalink(),
            'description'    => get_excerpt_by_id(get_the_id(), '', 'nolink'),
            'homepage_image' => $homepage_image,
            'eventTicketUrl' => get_field('eventTicketUrl'),
        );
    }

    return $upcoming_events;
    wp_reset_postdata();
}
