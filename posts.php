<?php
$url = 'https://www.facebook.com/astrolojiyolculugu/posts';
$user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0 Safari/537.36';
$page = file_get_contents($url, false, stream_context_create(['http' => ['user_agent' => $user_agent]]));
preg_match_all('/astrolojiyolculugu\/posts\/\d+/', $page, $posts_match);
$posts_values = array_map(function ($v) { return explode('/', $v)[2]; }, $posts_match[0]);
preg_match_all('/astrolojiyolculugu\/photos\/a\.\d+\/\d+/', $page, $photos_match);
$photos_values = array_map(function ($v) { return explode('/', $v)[3]; }, $photos_match[0]);
$values = array_values(array_unique(array_merge($posts_values, $photos_values)));
rsort($values);
echo json_encode($values);
