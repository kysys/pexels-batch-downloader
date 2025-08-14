<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloaded Images Viewer</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .stats {
            background: #e8f5e8;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .image-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .image-card:hover {
            transform: translateY(-5px);
        }
        .image-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .image-info {
            padding: 15px;
        }
        .filename {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        .file-size {
            color: #666;
            font-size: 14px;
        }
        .no-images {
            text-align: center;
            color: #666;
            padding: 50px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .refresh-btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .refresh-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📸 Downloaded Images</h1>
        
        <button class="refresh-btn" onclick="location.reload();">🔄 Refresh</button>
        
        <?php
        $downloadDir = __DIR__ . '/download/';
        $webPath = './download/';
        
        // Check if download directory exists
        if (!file_exists($downloadDir)) {
            echo '<div class="no-images">Download directory does not exist yet. Start downloading some images first!</div>';
        } else {
            // Get all image files
            $images = glob($downloadDir . '*.{jpg,jpeg,png,gif,webp,JPG,JPEG,PNG,GIF,WEBP}', GLOB_BRACE);
            
            if (empty($images)) {
                echo '<div class="no-images">No images found. Start downloading some images first!</div>';
            } else {
                // Sort by modification time (newest first)
                usort($images, function($a, $b) {
                    return filemtime($b) - filemtime($a);
                });
                
                $totalSize = 0;
                foreach ($images as $image) {
                    $totalSize += filesize($image);
                }
                
                echo '<div class="stats">';
                echo '<strong>' . count($images) . '</strong> images | ';
                echo '<strong>' . number_format($totalSize / 1024 / 1024, 2) . ' MB</strong> total size';
                echo '</div>';
                
                echo '<div class="gallery">';
                
                foreach ($images as $imagePath) {
                    $filename = basename($imagePath);
                    $webImagePath = $webPath . $filename;
                    $fileSize = filesize($imagePath);
                    $fileSizeKB = number_format($fileSize / 1024, 1);
                    $modifiedDate = date('Y-m-d H:i:s', filemtime($imagePath));
                    
                    echo '<div class="image-card">';
                    echo '<img src="' . htmlspecialchars($webImagePath) . '" alt="' . htmlspecialchars($filename) . '" loading="lazy">';
                    echo '<div class="image-info">';
                    echo '<div class="filename">' . htmlspecialchars($filename) . '</div>';
                    echo '<div class="file-size">' . $fileSizeKB . ' KB | ' . $modifiedDate . '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                
                echo '</div>';
            }
        }
        ?>
        
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
            <a href="./" style="color: #007bff; text-decoration: none;">← Back to Image Downloader</a>
        </div>
    </div>
</body>
</html>
