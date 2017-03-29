<?php
return [
    'name' => "MyBlog",
    'title' => "MyBlog",
    'subtitle' => 'http://blog.local.com',
    'description' => 'This is my blog',
    'author' => 'Admin',
    'page_image' => 'home-bg.jpg',
    'posts_per_page' => 5,
    'rss_size'=>25,
    'uploads' => [
        'storage' => 'local',
        'webpath' => '/uploads/',
    ],
    'contact_email'=>env('MAIL_TO'),
];