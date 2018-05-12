<?php
function getCustomPosts($posttype = '', $limit = '', $category = '', $order = 'title', $excluded = null, $tag = null)
{

    if (is_numeric($category)) {
        $category = get_cat_name($category);
    }

    $args = array(
        'posts_per_page' => $limit,
        'post_type'      => $posttype,
        'order'          => 'DESC',
        'orderby'        => $order,

    );

    // If there's a category to filter by, we're gonna go ahead and do that
    if ($category != null) {
        $args['category_name'] = $category;
    }
    if ($tag != null) {
        $args['tag'] = $tag;
    }
    // If there's an excluded post (for example, the current post) we add that here
    if ($excluded != null) {
        if (is_array($excluded)) {
            $args['post__not_in'] = $excluded;
        } else {
            $args['post__not_in'] = array($excluded);
        }
    }

    $loop = new WP_Query($args);

    // Empty array for the terms

    if ($loop->have_posts()) {
        while ($loop->have_posts()) {

            // Setting up post data
            $loop->the_post();

            // Fill the array with post data we changed in getSinglePost
            $array[] = getSinglePost($posttype);
        }

        // Restores original Post Data
        wp_reset_postdata();

        // Returns an array of terms.
        if ($limit === 1) {
            $array = $array['0'];
        }

        return $array;

    }
}

function getSinglePost($posttype = null, $id = null)
{
    if ($id = null) {
        $postId = get_the_id();
    } else {
        $postId = $id;
    }
    $thumbnailId   = get_post_thumbnail_id();
    $attachedimage = null;
    if (!empty($thumbnailId)) {
        $attachedimage = new TimberImage($thumbnailId);
    }

    $categories = get_the_category();

    // setup an array to change the post data returned
    $singlePostArray = array(
        'date'       => get_the_date('Y-m-d', $postId),
        'id'         => $postId,
        'title'      => get_the_title(),
        'categories' => $categories,
        'tags'       => get_the_tags(),
        'post_type'  => $posttype,
        'image'      => $attachedimage,
        'link'       => get_permalink(),
    );

    // Restores original Post Data
    wp_reset_postdata();

    return $singlePostArray;
}
