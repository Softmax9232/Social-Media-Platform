<?php

session_start();

if(!isset($_SESSION['id']))
{
    header('location: login.php');

    exit;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Title</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>

    <title>Document</title>

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/section.css">

    <link rel="stylesheet" href="assets/css/right_col.css">

    <link rel="stylesheet" href="assets/css/posting.css">

    <link rel="stylesheet" href="assets/css/responsive.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="notifast/notifast.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .post-source{

            width: 100%;

            height: 500px;

            object-fit: cover;

            border-radius: 10px;

        }

    </style>
</head>

<body>

<?php if(isset($_GET['error_message'])){ ?>

    <?php

    $message = $_GET['error_message'];

    echo"<body onload='notification_function(`Error Message`, `$message`, `#da1857`);'</body>"

    ?>

<?php }?>

<?php if(isset($_GET['success_message'])){ ?>

    <?php

    $message = $_GET['success_message'];

    echo"<body onload='notification_function(`Success Message`, `$message`, `#0F73FA`);'</body>"

    ?>

<?php }?>
<!-- Nav Bar Design -->

<nav class="navbar">

    <div class="nav-wrapper">

        <img src="assets/images/black_logo.png" class="brand-img">

        <form>
            <input type="text" class="search-box" placeholder="search">
        </form>

        <div class="nav-items">

            <i class="icon fas fa-home fa-lg"></i>

            <i class="icon fas fa-plus-square fa-lg"></i>

            <i class="icon fas fa-calendar-alt fa-lg"></i>

            <i class="icon fas fa-heart fa-lg"></i>

            <div class="icon user-profile">

                <i class="fas fa-user-circle fa-lg"></i>

            </div>

        </div>

    </div>

</nav>


<!-- New Section -->


<section class="main">

    <div class="wrapper">

        <!-- Design for left column -->

        <div class="left-col">

            <!-- Wrapper for posting -->

            <div class="post">

                <div class="info">

                    <div class="user">

                        <div class="profile-pic"><img src="assets/images/default.png"></div>

                        <p class="username">SLTC Leo Club</p>

                    </div>

                    <i class="fas fa-ellipsis-v options"></i>

                </div>

                <video controls class="post-source" muted poster="assets/images/shorts/sample.jpeg">

                    <source src="assets/images/shorts/sample.mp4" type="video/mp4">

                </video>

                <div class="post-content">

                    <div class="reactions-wrapper">

                        <i class="icon fas fa-thumbs-up"></i>

                        <i class="icon fas fa-comment"></i>

                        <i class="icon fas fa-calendar-alt"></i>

                    </div>

                    <p class="reactions">1,789 Reactions</p>

                    <p class="description">
                        <span>Username Says : <br></span>
                        "Perry the Platypus" is a background theme song played as Agent P embarks on a mission to stop Dr. Doofenshmirtz. It was mostly runs in small fragments
                    </p>

                    <p class="description">Event Will Be Held On : <span>2nd January 2023</span> At : <span>University Main Hall</span></p>

                    <p class="description"><span>Invite Link : <a href="www.facebook.com">www.facebook.com</a> </span></p>

                    <p class="description"><span>#moon-land #sltc #events</span></p>

                    <p class="post-time">2022/11/5</p>

                </div>

                <div class="comments-section">

                    <img src="assets/images/default.png" class="icon">

                    <input type="text" class="comment-box" placeholder="Your Opinion">

                    <button class="comment-button">WRITE</button>

                </div>

            </div>

            <?php

            include('get_latest_events.php');

            include('get_dataById.php');

            foreach($posts as $post)
            {
                $data = get_UserData($post['User_ID']);

                $profile_img = $data[2];

                $profile_name = $data[0];

                ?>

                <div class="post">

                    <div class="info">

                        <div class="user">

                            <div class="profile-pic"><img src="<?php echo "assets/images/profiles/". $profile_img; ?>"></div>

                            <p class="username"><?php echo $profile_name;?></p>

                        </div>

                        <i class="fas fa-ellipsis-v options"></i>

                    </div>

                    <img src="<?php echo "assets/images/posts/". $post['Event_Poster']; ?>" class="post-img">

                    <div class="post-content">

                        <div class="reactions-wrapper">

                            <?php

                            include('check_like_status_events.php');?>

                            <?php if($reaction_status){?>

                                <form action="unlike_event.php" method="post">
                                    <input type="hidden" value="<?php echo $post['Event_ID'];?>" name="post_id">
                                    <button style="background: none; border: none;" type="submit" name="reaction">
                                        <i style="color: #fb3958;" class="icon fas fa-heart"></i>
                                    </button>
                                </form>

                            <?php } else{?>

                                <form action="like_events.php" method="post">
                                    <input type="hidden" value="<?php echo $post['Event_ID'];?>" name="post_id">
                                    <button style="background: none; border: none;" type="submit" name="reaction">
                                        <i style="color: #22262A;" class="icon fas fa-heart"></i>
                                    </button>
                                </form>

                            <?php }?>

                            <a href="Single-Video.php?post_id=<?php echo $post["Event_ID"];?>" style="color: #22262A;"><i class="icon fas fa-comment"></i></a>

                            <a href="#" style="color: #22262A;"><i class="icon fas fa-calendar-alt"></i></a>

                        </div>

                        <p class="reactions"><?php echo $post['Likes'];?> Reactions</p>

                        <p class="description">
                            <span><?php echo $profile_name;?> Says :<br></span>

                            <?php echo $post['Caption'];?>
                        </p>

                        <p class="description">Event Will Be Held On : <span><?php echo $post['Event_Date'];?></span> At : <span><span><?php echo $post['Event_Time'];?></span></p>

                        <p class="description"><span>Invite Link : <a href="<?php echo $post['Invite_Link'];?>"><?php echo $post['Invite_Link'];?></a></span></p>

                        <p class="description"><span><?php echo $post['HashTags'];?></span></p>

                        <p class="post-time"><?php echo date("M,Y,d", strtotime($post['Date_Upload']));?></p>

                    </div>

                </div>

            <?php } ?>

        </div>

        <!-- Design for right column -->

        <div class="right-col">

            <!-- structure for profile card section-->

            <div class="profile_card">

                <div class="profile-pic">

                    <img src="assets/images/default.png">

                </div>

                <div>

                    <p class="username">EventsWave Official</p>

                    <p class="sub-text">Events with Elegance</p>

                </div>

                <form method="GET" action="logout.php">
                    <button class="logout-btn">LogOut</button>
                </form>

            </div>

        </div>

    </div>

</section>

<nav aria-label="Page navigation example" class="mx-auto mt-3">

    <ul class="pagination">

        <li class="page-item <?php if($page_no<=1){echo 'disabled';}?>">

            <a class="page-link" href="<?php if($page_no<=1){echo'#';}else{ echo '?page_no='. ($page_no-1); }?>">Previous</a>

        </li>
        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>

        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

        <li class="page-item"><a class="page-link" href="?page_no=3">3</a></li>
        <?php if($page_no >= 3){?>

            <li class="page-item"><a class="page-link" href="#">...</a></li>

            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=". $page_no;?>"></a></li>

        <?php } ?>

        <li class="page-item <?php if($page_no>= $total_number_pages){echo 'disabled';}?>">

            <a class="page-link" href="<?php if($page_no>=$total_number_pages){echo "#";}else{ echo "?page_no=".($page_no+1);}?>">Next</a>

        </li>
    </ul>
</nav>

</body>

<script src="notifast/notifast.min.js"></script>

<script src="notifast/function.js"></script>

</html>
