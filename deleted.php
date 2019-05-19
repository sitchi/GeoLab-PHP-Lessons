<?php

$title = 'PHP - Lesson 3';
require('head.php'); // load header

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $func->int($_POST['id']);
    $token = strip_tags($_POST['token']);
    // chek token
    if (!$func->checkToken($token)) {
        // redirect deleted page
        $func->redirect('deleted.php');
    }
    if (isset($_POST['delete'])) {
        // get post by id
        $post = $db->fetch("SELECT imageName FROM `posts` WHERE id = $id");
        if (!empty($post)) {
            $imageName = $post['imageName'];
            $file = ($imageName) ? 'uploads/'.$imageName.'.jpg' : null;
            // delete post
            $sql = "DELETE FROM `posts` WHERE id = :id";
            $data = ['id' => $id];
            $db->delete($sql, $data, $file);
        }
    }
    if (isset($_POST['restore'])) {
        $id = $func->int($_POST['id']);
        // restore post
        $sql = "UPDATE `posts` SET `deleted`=:deleted WHERE id = :id";
        $data = [
            'deleted' => null,
            'id' => $id
        ];
        $db->update($sql, $data);
    }
    // redirect deleted page
    $func->redirect('deleted.php');
}

$func->createToken();
$token = $_SESSION['token'];
$data = $db->fetchAll("SELECT id, title, description, imageName, deleted, date FROM posts WHERE deleted IS NOT NULL ORDER BY id DESC");

if (!empty($data)) {
    ?>
    <div class="container py-5">
        <h5>წაშლილი პოსტები / რაოდენობა: <?=count($data)?></h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>img</th>
                        <th>სათაური</th>
                        <th>აღწერა</th>
                        <th>წაშლის თარიღი</th>
                        <th>თარიღი</th>
                        <th>მოქმედება</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $row) {
                        $image = ($row['imageName']) ? 'uploads/'.$row['imageName'].'.jpg' : 'img/noimage.jpg'; ?>
                        <tr>
                            <td><?=$row['id']?></td>
                            <td><img src="<?=$image?>" class="img-fluid" style="width:40px;"></td>
                            <td><?=$row['title']?></td>
                            <td><?=$func->getShortText($row['description'])?></td>
                            <td><?=$row['deleted']?></td>
                            <td><?=$row['date']?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                    <input type="hidden" name="token" value="<?=$token?>">
                                    <div class="btn-group">
                                        <input type="submit" name="restore" value="აღდგენა" class="btn btn-sm btn-warning">
                                        <input type="submit" name="delete" value="წაშლა" class="btn btn-sm btn-danger">
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
} else {
                        echo '<div class="container py-5">
    <center><p>წაშლილი პოსტები არ არის.<p>
    </center>
    </div>';
                    }
require('footer.php');
