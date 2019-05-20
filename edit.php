<?php

$title = 'პოსტის რედაქტირება';
require('head.php'); // load header

$id = $func->int($_GET['id']);

$data = $db->fetch("SELECT id, title, description, imageName, date FROM posts WHERE deleted IS NULL AND id='$id'");

if (!$data) {
    // redirect home page
    $func->redirect();
}

if (isset($_POST['editPost'])) {
    $fileName = uniqid();
    $targetFile = 'uploads/'.$fileName.'.jpg';

    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);
    $oldImage = $data['imageName'];
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];

    if ($imageName!= NULL && $func->getFileExtension($imageName)!='jpg') {
        // redirect home page
        $func->redirect();
    }

    $fileName = ($imageName) ? $fileName : $oldImage;

    // update post
    $sql = "UPDATE `posts` SET `title`=:title, `description`=:description, `imageName`=:imageName  WHERE id = :id";
    $data = [
        'id' => $id,
        'title' => $title,
        'description' => $description,
        'imageName' => $fileName,
    ];
    $db->update($sql, $data);

    if($imageName){
        move_uploaded_file($imageTmp, $targetFile);
        // remove old img
        if ($oldImage) {
            unlink('uploads/'.$oldImage.'.jpg'); // remove file
        }
    }

    // redirect home page
    $func->redirect();
}
$image = ($data['imageName']) ? 'uploads/'.$data['imageName'].'.jpg' : 'img/noimage.jpg';
?>
<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <h5>პოსტის რედაქტირება</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">სათაური</label>
                        <input name="title" class="form-control" value="<?=$data['title']?>" placeholder="შეიყვანეთ სათაური">
                    </div>
                    <div class="form-group">
                        <label for="description">აღწერა</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="შეიყვანეთ აღწერა"><?=$data['description']?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">ფოტო</label>
                        <div class="col-6">
                            <img src="<?=$image?>" class="img-fluid" alt="<?=$data['imageName']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">ფოტოს შეცვლა</label>
                        <input type="file" name="image" class="form-control" value="<?=$data['imageName']?>" accept="image/jpg">
                    </div>
                    <hr>
                    <div class="btn-group">
                        <input type="submit" name="editPost" value="განახლება" class="btn btn-success">
                        <a href="/" class="btn btn-warning">გაუქმება</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <?php
    require('footer.php');
