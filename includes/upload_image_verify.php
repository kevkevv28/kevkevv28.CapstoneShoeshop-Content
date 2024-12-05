<?php


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save_photos"])) {
    $userId = $_POST["userId"];
    $files = $_FILES['idPictures'];

    try {
        require_once 'dbh.inc.php'; // Database connection
        

        $uploadDir = "../assets/userverify/"; // Folder to save files
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $uploadedFiles = [];
        $errors = [];

        // Error handling for empty fields
        if (empty($userId)) {
            $errors['emptyUserId'] = "User ID is missing.";
        }

        if (empty($files['name'][0])) {
            $errors['emptyFiles'] = "No files selected for upload.";
        }

        if ($errors) {
            include_once 'config_session.inc.php';
            $_SESSION["errors_verification"] = $errors;
            header("Location: ../profilePage.php");
            die();
        }

        // Loop through the uploaded files
        foreach ($files['name'] as $key => $fileName) {
            $fileTmpName = $files['tmp_name'][$key];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Validate file extension
            if (!in_array($fileExt, $allowedExtensions)) {
                $errors["invalidFile_$key"] = "$fileName has an invalid file extension.";
                continue;
            }

            // Create a unique name for the file and move it
            $uniqueFileName = uniqid() . "_" . $fileName;
            $filePath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($fileTmpName, $filePath)) {
                $uploadedFiles[] = $uniqueFileName;

                // Save the file information in the database
                $sql = "INSERT INTO user_verifications (user_id, file_path) VALUES (:userId, :fileName)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':userId' => $userId,
                    ':fileName' => $uniqueFileName,
                ]);
            } else {
                $errors["uploadError_$key"] = "$fileName could not be uploaded.";
            }
        }

        include_once 'config_session.inc.php';

        // Set success or error messages in the session
        if ($uploadedFiles) {
            $_SESSION["success_verification"] = [
                'success' => "Files uploaded successfully. Please wait while our admin reviews them.",
     
            ];
        }

        if ($errors) {
            $_SESSION["errors_verification"] = $errors;
        }

        header("Location: ../profilePage.php");
        $pdo = null; // Close the database connection
        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}

