<?php

$title = 'PHP - Lesson 3';
require('head.php'); // load header

if (isset($_POST['delete'])) {
    $id = $func->int($_POST['id']);

    // delete post
    $sql = "UPDATE `posts` SET `deleted`=:deleted WHERE id = :id";
    $data = [
        'deleted' => date('Y-m-d H:i:s'),
        'id' => $id
    ];
    $db->update($sql, $data);

    // redirect home page
    $func->redirect();
}

$data = $db->fetchAll("SELECT id, title, description, imageName, date FROM posts WHERE deleted IS NULL ORDER BY id DESC");

if (!empty($data)) {
    ?>
    <div class="container py-5">
        <div class="row">
            <?php
            foreach ($data as $row) {
                $image = ($row['imageName']) ? 'uploads/'.$row['imageName'].'.jpg' : 'img/noimage.jpg'; ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="col-12 image" style="background-image: url(<?=$image?>);">
                            <div class="title"><?=$row['title']?></div>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?=$row['description']?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <form method="post">
                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                    <div class="btn-group">
                                        <a class="btn btn-sm btn-info" href="/edit.php?id=<?=$row['id']?>">რედ.</a>
                                        <input type="submit" name="delete" value="წაშ." class="btn btn-sm btn-warning">
                                    </div>
                                </form>
                                <small class="text-muted"><?=$row['date']?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
    <?php
} else {
                echo '<div class="container py-5">
    <center><p>პოსტები არ არის.<p>
    <a class="text-success" href="/newPost.php">დაამატე პირველი პოსტი</a>
    </center>
    </div>';
            }
require('footer.php');
