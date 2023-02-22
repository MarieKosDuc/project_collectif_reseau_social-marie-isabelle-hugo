<?php include('connect.php'); 

// Get all Social Animals posts
$getPostsRequest = "
        SELECT posts.description, posts.date, posts.photo, posts.id as ID, user_id 
        FROM posts
        ";
$postsInfos = $mysqli->query($getPostsRequest);

if (!$postsInfos) {
    echo ("Échec de la requete : " . $mysqli->error);
}

// Send SQL request to like/unlike post
include('like.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Animals</title>
    <link href="output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-yellow-50">
    <?php
    
    include('header.php');
    ?>
    <div class="flex">
        <?php
        include('typecol.php');
        ?>
        <div class="flex flex-col w-screen justify-center items-center space-y-8">
            <main>
            <?php
            // if(isset($_POST['type']))
                    // {
                    //    foreach($_POST['type'] as $value)
                    //    {
                    //       echo $value ;
                    //    }
                    // }
            
                
                while ($post = $postsInfos->fetch_assoc()) {?>
                <article class="flex flex-col items-center bg-orange-100 mt-20 rounded-lg mx-80 pb-24 ">
                    <a class="pt-10">
                        <address>
                            <?php 
                            $postUser = $post['user_id'];
                            $newSql = "SELECT users.name as user_name FROM users WHERE users.ID = $postUser";
                            $postsInfos2 = $mysqli->query($newSql);
                            $postUserName = $postsInfos2->fetch_assoc();
                            ?><a class="text-3xl" href="profile.php?user_id=<?php echo $post['user_id']?>"><?php echo $postUserName['user_name']; ?></a>
                        </address>
                    </a>
                    <div class="pt-6 mx-12"> 
                        <a class="bg-black w-96 h-96 ">
                            <img class="object-cover h-96 w-96 "src="upload/<?php echo $post['photo']; ?>">
                        </a>
                    </div>
                    <h3 class="pt-6 text-xl">
                        <time datetime="Y-m-d\\TH:i:sP">
                            <?php echo $post['date']; ?>
                        </time>
                    </h3>
                    <div class="pt-6 text-xl">
                        <p>
                            <?php echo $post['description']; ?>
                        </p>
                    </div>
                    <!-- Include likes button -->
                    <?php include('likebutton.php'); ?>
                </article>
            <?php } ?>
            </main>
        </div>
    </div>
</body>

</html>
