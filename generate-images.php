<?php
/**
 * Generate placeholder car images
 * Run once on the server: php generate-images.php
 */

$imagesDir = __DIR__ . '/images/vehicles';

// Create directory if it doesn't exist
if (!is_dir($imagesDir)) {
    mkdir($imagesDir, 0755, true);
    echo "Created directory: $imagesDir\n";
}

// Generate 15 placeholder images
for ($i = 1; $i <= 15; $i++) {
    $filename = $imagesDir . '/car-' . $i . '.jpg';
    
    // Create image
    $image = imagecreatetruecolor(800, 600);
    
    // Define colors for variety
    $colors = [
        ['r' => 31, 'g' => 60, 'b' => 114],
        ['r' => 42, 'g' => 82, 'b' => 152],
        ['r' => 230, 'g' => 126, 'b' => 34],
        ['r' => 52, 'g' => 152, 'b' => 219],
        ['r' => 46, 'g' => 204, 'b' => 113]
    ];
    
    $color = $colors[$i % count($colors)];
    $bgColor = imagecolorallocate($image, $color['r'], $color['g'], $color['b']);
    $textColor = imagecolorallocate($image, 255, 255, 255);
    $lightColor = imagecolorallocate($image, 200, 200, 200);
    
    // Fill background
    imagefilledrectangle($image, 0, 0, 800, 600, $bgColor);
    
    // Add simple text
    imagestring($image, 5, 250, 280, 'Vehicle ' . $i, $textColor);
    imagestring($image, 3, 220, 320, 'Placeholder Image (800x600)', $lightColor);
    
    // Save image
    imagejpeg($image, $filename, 90);
    imagedestroy($image);
    
    echo "Created: $filename\n";
}

echo "\nAll placeholder images generated successfully!\n";
?>
