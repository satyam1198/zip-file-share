<?php

namespace App\Controllers;


class UploadController {
    public function index()
    {
        $filePath = __DIR__ . '/../Resources/upload/index.php';

        if (file_exists($filePath)) {
            include_once $filePath;
        } else {
            echo 'Error: File not found.';
        }
        
    }

    public function handleUploadAndZip()
    { 
        if (isset($_FILES['files']['tmp_name']) && is_array($_FILES['files']['tmp_name'])) {
            $uploadedFiles = [];

            foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
                $temp_file = $_FILES['files']['tmp_name'][$key];
                $upload_dir = 'uploads/';
                $upload_file = $upload_dir . basename($_FILES['files']['name'][$key]);
                move_uploaded_file($temp_file, $upload_file);
                $uploadedFiles[] = $upload_file;
            }

            $zipName = 'uploads/zipFolder/zip.zip';
            touch($zipName);

            if ($this->createZip($uploadedFiles, $zipName)) {
                session_start();

                $_SESSION['message'] = "Zip Created Successfully!";
                $_SESSION['zip_file'] = $zipName;
                header("Location: http://local-zip-file.com");
                exit;
                session_destroy();

            } else {
                echo 'Failed to create zip archive.';
            }
        } else {
            echo 'No files uploaded.';
        }
    }

    
    private function createZip($files, $zipName)
    {
        $zip = new \ZipArchive;
    
        if ($zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            return false;
        }
    
        foreach ($files as $file) {
            if (file_exists($file)) {
                $zip->addFile($file, basename($file));
            } else {
                continue;
            }
        }
    
        $zip->close();
        return file_exists($zipName);
    }


    public function displayZipFile()
    {
        if (isset($_SESSION['zip_file'])) {
            echo '<a href="' . htmlspecialchars($_SESSION['zip_file'], ENT_QUOTES, 'UTF-8') . '">Download Zip File</a>';
        }
    }
}