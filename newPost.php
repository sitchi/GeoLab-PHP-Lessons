<?php

$title = 'პოსტის დამატება';
require('head.php'); // load header

if (isset($_POST['newPost'])) {
    $fileName = uniqid();
    $targetFile = 'uploads/'.$fileName.'.jpg';

    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];

    $fileName = ($imageName) ? $fileName : null;

    $sql = "INSERT INTO posts (title, description, imageName, date) VALUES (:title, :description, :imageName, :date)";
    $data = [
        'title' => $title,
        'description' => $description,
        'imageName' => $fileName,
        'date' => date('Y-m-d H:i:s')
    ];
    $db->insert($sql, $data);

    move_uploaded_file($imageTmp, $targetFile);
    //$ext = $func->getFileExtension($imageName);
    // redirect home page
    $func->redirect();
}
?>
<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <h5>ახალი პოსტის დამატება</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">სათაური</label>
                        <input name="title" class="form-control" placeholder="შეიყვანეთ სათაური">
                    </div>
                    <div class="form-group">
                        <label for="description">აღწერა</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="შეიყვანეთ აღწერა"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">ფოტო</label>
                        <input type="file" name="image" class="form-control" accept="image/jpg">
                    </div>
                    <hr>
                    <div class="btn-group">
                        <input type="submit" name="newPost" value="დამატება" class="btn btn-success">
                        <a href="/" class="btn btn-warning">გაუქმება</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <?php
    require('footer.php');
