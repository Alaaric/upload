<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uploadDir = 'public/uploads/';

    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

    $uniqueName = uniqid($_FILES['avatar']['name'], true);

    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtension = ['jpg', 'jpeg', 'png'];
    $maxFileSize = 2000000;

    if (!in_array($extension, $authorizedExtension)) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 2M !";
    }
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
    <button name="send">Send</button>
</form>