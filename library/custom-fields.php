<?php

function prepareHomepageFields()
{
    if (have_rows('field_5af4cee20585b')) {
        $links = array();
        while (have_rows('field_5af4cee20585b')) {
            the_row();

            $links[] = get_sub_field('field_5af4ceea0585c');
        }
    }

    $layout = array(
        'layout'   => get_field('field_5af48e75afb32'),
        'title'    => get_field('field_5af4d76d09204'),
        'subtitle' => get_field('field_5af4d77d09205'),
    );

    $headerImages = get_field('field_5af60e41bbeda');

    if (!empty($headerImages)) {
        $theImage = array_rand($headerImages, 1);

        $headerImage = new TimberImage($headerImages[$theImage]['ID']);
    } else {
        $headerImage = null;
    }
    $banner = array(
        'text'   => get_field('field_5589b049b683f'),
        'url'    => get_field('field_5589b071b6840'),
        'target' => get_field('field_5589b085b6841'),
    );

    $eventIds = get_field('field_558b168a98f48');
    if (!empty($eventIds)) {
        $events = array();
        foreach ($eventIds as $event) {
            $imageId = get_post_thumbnail_id($event);
            $image   = null;
            if (!empty($imageId)) {
                $image = new TimberImage($imageId);
            }
            $date = get_field('field_558b9672c7fdf', $event);
            if (empty($date)) {
                $date = get_field('field_57834abc64615', $event);
            }
            $events[] = array(
                'image' => $image,
                'title' => get_the_title($event),
                'date'  => $date,
                'link'  => get_the_permalink($event),
            );
        }
    }
    $events = array(
        'events' => $events,
        'title'  => get_field('field_5af614d33cc39'),
        'link'   => get_field('field_5af61392a00b2'),
        'by'     => get_field('field_5af615341b1bc'),
    );
    $about = array(
        'title'   => get_field('field_5af61355a00af'),
        'content' => get_field('field_5af61369a00b0'),
        'link'    => get_field('field_5af6137aa00b1'),
    );
    // $newsId = get_field('field_5589acc05ff4f');
    // if (empty($newsId)) {
    //     $news = getCustomPosts('post', 1, null, 'date', null, null);
    // } else {
    //     wp_reset_postdata();
    //     $news = getSinglePost('post', $newsId);
    // }
    $newsId = get_field('field_5589acc05ff4f');
    $news   = array(
        'title' => get_the_title($newsId),
        'link'  => get_the_permalink($newsId),
        'image' => new TimberImage(get_post_thumbnail_id($newsId)),
    );
    $home = array(
        'navigation'  => $links,
        'headerimage' => $headerImage,
        'layout'      => $layout,
        'about'       => $about,
        'banner'      => $banner,
        'events'      => $events,
        'news'        => $news,

    );
    return $home;
}

function prepareQuickLinks()
{
    if (have_rows('field_558897ddf29f5')) {
        $links = array();
        while (have_rows('field_558897ddf29f5')) {
            the_row();
            $target     = get_sub_field('field_558898b6ebaa6');
            $linkTarget = '_self';
            if ($target == 'external') {
                $linkTarget = '_blank';
                $url        = get_sub_field('field_55889807f29f7');
            } else {
                $url = get_sub_field('field_5588991f8e71a');
            }

            $links[] = array(
                'target' => $linkTarget,
                'title'  => get_sub_field('field_558897fff29f6'),
                'url'    => $url,
            );
        }
    } elseif (have_rows('field_558897ddf29f5', 82)) {
        $links = array();
        while (have_rows('field_558897ddf29f5', 82)) {
            the_row();
            $target     = get_sub_field('field_558898b6ebaa6', 82);
            $linkTarget = '_self';
            if ($target == 'external') {
                $linkTarget = '_blank';
                $url        = get_sub_field('field_55889807f29f7', 82);
            } else {
                $url = get_sub_field('field_5588991f8e71a', 82);
            }

            $links[] = array(
                'target' => $linkTarget,
                'title'  => get_sub_field('field_558897fff29f6', 82),
                'url'    => $url,
            );
        }
    } else {
        $links = null;
    }

    return $links;
}

function prepareFeaturedSponsors()
{
    if (have_rows('field_5af4939184633', 'options')) {
        $sponsor = array();
        while (have_rows('field_5af4939184633', 'options')) {
            the_row();
            $sponsorImageId = get_sub_field('field_5af493ab84634', 'options');
            $sponsorImage   = null;
            if (!empty($sponsorImageId)) {
                $sponsorImage = new TimberImage($sponsorImageId);
            }
            $sponsor[] = array(
                'image' => $sponsorImage,
                'link'  => get_sub_field('field_5af493d084635', 'options'),
            );
        }
    }
    $section = array(
        'title'    => get_field('field_5af4c25ce137c', 'options'),
        'link'     => get_field('field_5af4944b84639', 'options'),
        'sponsors' => $sponsor,
    );
    return $section;
}

function preparePartners()
{
    if (have_rows('field_5af493fd84636', 'options')) {
        $partner = array();
        while (have_rows('field_5af493fd84636', 'options')) {
            the_row();
            $partnerImageId = get_sub_field('field_5af493fd84637', 'options');
            $partnerImage   = null;
            if (!empty($partnerImageId)) {
                $partnerImage = new TimberImage($partnerImageId);
            }
            $partner[] = array(
                'image' => $partnerImage,
                'link'  => get_sub_field('field_5af493fd84638', 'options'),
            );
        }
    }
    $section = array(
        'title'    => get_field('field_5af4c26ae137d', 'options'),
        'partners' => $partner,
    );
    return $section;
}
