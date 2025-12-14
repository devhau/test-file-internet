<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$uploadDir = 'uploads/';
$maxFileSize = 500 * 1024 * 1024; // 500MB
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/zip'];

$message = '';
$uploadTime = 0;

// Create uploads directory if it doesn't exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileSize = $file['size'];
    $fileType = $file['type'];
    $fileName = basename($file['name']);
    $targetPath = $uploadDir . $fileName;
    
    // Check for errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $message = 'Error during file upload: ' . $file['error'];
    } 
    // Check file size
    elseif ($fileSize > $maxFileSize) {
        $message = 'File is too large. Maximum size is ' . ($maxFileSize / (1024 * 1024)) . 'MB';
    }
    // Check file type
    elseif (!in_array($fileType, $allowedTypes)) {
        $message = 'Invalid file type. Allowed types: ' . implode(', ', $allowedTypes);
    } 
    // Try to upload file
    else {
        $startTime = microtime(true);
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $endTime = microtime(true);
            $uploadTime = round($endTime - $startTime, 2);
            $fileSizeMB = round($fileSize / (1024 * 1024), 2);
            $speed = $fileSizeMB / $uploadTime;
            
            $message = sprintf(
                'File uploaded successfully!<br>' .
                'File: %s<br>' .
                'Size: %s MB<br>' .
                'Time: %s seconds<br>' .
                'Speed: %.2f MB/s',
                htmlspecialchars($fileName),
                $fileSizeMB,
                $uploadTime,
                $speed
            );
        } else {
            $message = 'Failed to move uploaded file.';
        }
    }
}
?>