<?php

// Get from the API
function instagram_api_request($id = null, $access_token = null)
{

    $instaOutputURL = 'https://api.instagram.com/v1/users/' . $id . '/media/recent/?access_token=' . $access_token;

    $instaOutputJSON = file_get_contents($instaOutputURL);
    $instaOutputJSON = json_decode($instaOutputJSON);

    return $instaOutputJSON->data;
}

// Caching Instagram API Results
function instagramResults($cache_file = null, $expires = null)
{
    global $request_type, $purge_cache, $limit_reached, $request_limit;

    if (!$cache_file) {
        $cache_file = dirname(__FILE__) . '/api-cache.json';
    }

    if (!$expires) {
        $expires = time() - 2 * 60 * 60;
    }

    if (!file_exists($cache_file)) {
        // die("Cache file is missing: $cache_file");
    }

    // Check that the file is older than the expire time and that it's not empty
    if (filectime($cache_file) < $expires || file_get_contents($cache_file) == '' || $purge_cache && intval($_SESSION['views']) <= $request_limit) {

// joshre
        //     id = 21878392
        //     key = 21878392.1677ed0.1225f01119d14e14a96b36f86acf5e7c
        // joshre_test
        //     id = 550437889
        //     key = 550437889.1677ed0.b2b590cd6ec9414789defc0dae388615
        // honey
        //     id = 27486739
        //     key = 27486739.1677ed0.14681975c1e54a3da82904e0cc3b90cb

        // File is too old, refresh cache
        $api_results  = instagram_api_request(1372446873, '1372446873.3a81a9f.af5cbfed69dc4c7f8e5e460cc442e111');
        $json_results = json_encode($api_results);

        // Remove cache file on error to avoid writing wrong xml
        if ($api_results && $json_results) {
            file_put_contents($cache_file, $json_results);
        } else {
            unlink($cache_file);
        }

    } else {
        // Check for the number of purge cache requests to avoid abuse
        if (!empty($_SESSION['views']) && intval($_SESSION['views']) >= $request_limit) {
            $limit_reached = " <span class='error'>Request limit reached ($request_limit). Please try purging the cache later.</span>";
        }

        // Fetch cache
        $json_results = file_get_contents($cache_file);
        $request_type = 'JSON';
    }
    return json_decode($json_results, true);
}

$instagramCache = dirname(__FILE__) . '/api-cache.json';

$instagramCachedResults = instagramResults($instagramCache, null);
// print_r($instagramCachedResults);
function filter_instagram_results($tags = null, $colorFilter = null)
{
    global $instagramCachedResults;
    foreach ($instagramCachedResults as $post) {
        if ($tags != null) {
            if (in_array($tags, $post[tags])) {
                return $post;
                break;
            }
        } elseif ($colorFilter != null) {
            if ($post['filter'] == $colorFilter) {
                return $post;
                break;
            }
        } else {
            return $instagramCachedResults[0];
        }

    }
}
