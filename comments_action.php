<?php

session_start();

include("config.php");

if(isset($_POST['submit']))
{
    $post_id = $_POST['post_id'];
    
    $comment = $_POST['comment'];
    
    $user_id = $_SESSION['id'];

    $date = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO comments(POST_ID, USER_ID, COMMENT, DATE)VALUES ($post_id, $user_id, '$comment', '$date');";

    echo ($sql);
    
    $stmt = $conn->prepare($sql);

    if($stmt->execute())
    {

        header("location: single-post.php?post_id=" . $post_id."&success_message=Your Opinion Was Submitted Successfully");
        
    }
    else
    {
        header("location: single-post.php?post_id=" . $post_id."&error_message=Your Opinion Submission Abort");

        echo "alert('Your Opinion was Submition Abort')";
    }

    exit;

}else
{
    header("location: home.php");

    exit;
}
?>