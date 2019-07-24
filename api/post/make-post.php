<?php
	require_once '../../app/init.php';

    require_once '../../config/Database.php';
    require_once '../../models/Post.php';


    $mobile=0;
    $postdata = json_decode(file_get_contents("php://input"));
    $post = array_merge($_REQUEST,(array)$postdata);

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $make_post = new Post($db);

    $make_post->makePost($post, $mobile);