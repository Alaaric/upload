<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uploadDir = 'uploads/';


    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtension = ['jpg', 'gif', 'png', "webp"];
    $maxFileSize = 1048576;
    define("uploadFile", $uploadDir . uniqid() . "." . $extension);

    if (!in_array($extension, $authorizedExtension)) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou gif ou Png ou webp!';
        echo($errors[1]);
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1Mo!";
        echo($errors[1]);
    }
    move_uploaded_file($_FILES['avatar']["tmp_name"], uploadFile);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload quest</title>
</head>

<form method="post" enctype="multipart/form-data">
    <label for="imageUpload">Upload a profile image</label>
    <input type="file" name="avatar" id="imageUpload"/>
    <label for="firstname">your firstname</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">your lastname</label>
    <input type="text" name="lastname" id="lastname">
    <label for="age">your age</label>
    <input type="number" name="age" id="age">
    <button name="send">Send</button>
</form>

<img src="<?= uploadFile ?>" alt="homer img">
<p>firstname: <?= $_POST["firstname"] ?></p>
<p>lastname: <?= $_POST["lastname"] ?></p>
<p>age: <?= $_POST["age"] ?></p>