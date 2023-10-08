<?php

// http://localhost:1234/storage/videos/index.php?video=ai-and-iot.mp4

// Get the binary video data
$video_data = file_get_contents('../../../storage/videos/'. $_GET['video']);


// Set the new video name
$new_video_name = 'new-video.png';

// Set the video header
header('Content-type: video/mp4');
header('Content-disposition: inline; filename=' . $new_video_name);


    // Display the video
    echo $video_data;

?>
