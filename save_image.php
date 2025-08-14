<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

try {
    // Check if image was uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('No image uploaded or upload error');
    }

    // Get filename from POST data
    $filename = isset($_POST['filename']) ? $_POST['filename'] : '';
    if (empty($filename)) {
        throw new Exception('Filename not provided');
    }

    // Sanitize filename
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);
    $filename = basename($filename); // Security: remove path traversal

    // Create download directory if it doesn't exist
    $downloadDir = __DIR__ . '/download/';
    if (!file_exists($downloadDir)) {
        if (!mkdir($downloadDir, 0755, true)) {
            throw new Exception('Failed to create download directory');
        }
    }

    // Set full file path
    $filePath = $downloadDir . $filename;

    // Move uploaded file to download directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
        
        // Optional: Log successful upload
        error_log("Image saved: " . $filePath);
        
        // Return success response
        echo json_encode([
            'success' => true,
            'message' => 'Image saved successfully',
            'filename' => $filename,
            'path' => '/download/' . $filename,
            'size' => filesize($filePath)
        ]);
        
    } else {
        throw new Exception('Failed to save image file');
    }

} catch (Exception $e) {
    
    // Log error
    error_log("Image save error: " . $e->getMessage());
    
    // Return error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
