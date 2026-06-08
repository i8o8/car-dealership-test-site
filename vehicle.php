<?php
// Vehicle Detail Page

// Get the vehicle ID from URL parameters
$vehicleId = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$vehicleId) {
    http_response_code(400);
    $error = 'Invalid vehicle ID';
} else {
    // Load vehicle data
    $vehiclesJson = file_get_contents(__DIR__ . '/data/vehicles.json');
    $vehicles = json_decode($vehiclesJson, true);
    
    // Find the vehicle with matching ID
    $vehicle = null;
    foreach ($vehicles as $v) {
        if ($v['id'] === $vehicleId) {
            $vehicle = $v;
            break;
        }
    }
    
    if (!$vehicle) {
        http_response_code(404);
        $error = 'Vehicle not found';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($vehicle) ? htmlspecialchars($vehicle['year'] . ' ' . $vehicle['make'] . ' ' . $vehicle['model']) : 'Vehicle'; ?> - Elite Auto Dealership</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Elite Auto Dealership</h1>
            <p>Your trusted source for quality vehicles</p>
        </div>
    </header>

    <main>
        <div class="container">
            <?php if (isset($error)): ?>
                <div class="error-page">
                    <h2>Error</h2>
                    <p><?php echo htmlspecialchars($error); ?></p>
                    <a href="/" class="back-button">← Back to Inventory</a>
                </div>
            <?php else: ?>
                <a href="/" class="back-button">← Back to Inventory</a>
                
                <div class="detail-container" data-vehicle-id="<?php echo htmlspecialchars($vehicle['id']); ?>" data-vin="<?php echo htmlspecialchars($vehicle['vin']); ?>" data-stock="<?php echo htmlspecialchars($vehicle['stock']); ?>">
                    <div class="detail-header">
                        <div class="detail-title-section">
                            <h1><?php echo htmlspecialchars($vehicle['year'] . ' ' . $vehicle['make'] . ' ' . $vehicle['model']); ?></h1>
                            <p style="color: #666; font-size: 1.1rem; margin-top: 0.5rem;">Trim: <?php echo htmlspecialchars($vehicle['trim']); ?></p>
                        </div>
                        <div>
                            <div class="detail-price">$<?php echo number_format($vehicle['price']); ?></div>
                        </div>
                    </div>
                    
                    <div class="detail-photos">
                        <?php foreach ($vehicle['photos'] as $photo): ?>
                            <img src="<?php echo htmlspecialchars($photo); ?>" alt="Vehicle photo" class="detail-photo">
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="detail-specs">
                        <div class="spec-item">
                            <div class="spec-label">Year</div>
                            <div class="spec-value"><?php echo htmlspecialchars($vehicle['year']); ?></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Make</div>
                            <div class="spec-value"><?php echo htmlspecialchars($vehicle['make']); ?></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Model</div>
                            <div class="spec-value"><?php echo htmlspecialchars($vehicle['model']); ?></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Trim</div>
                            <div class="spec-value"><?php echo htmlspecialchars($vehicle['trim']); ?></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Mileage</div>
                            <div class="spec-value"><?php echo number_format($vehicle['mileage']); ?> mi</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">VIN</div>
                            <div class="spec-value" style="font-family: 'Courier New', monospace; word-break: break-all;"><?php echo htmlspecialchars($vehicle['vin']); ?></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Stock #</div>
                            <div class="spec-value"><?php echo htmlspecialchars($vehicle['stock']); ?></div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Price</div>
                            <div class="spec-value">$<?php echo number_format($vehicle['price']); ?></div>
                        </div>
                    </div>
                    
                    <div class="detail-description">
                        <h3>Description</h3>
                        <p><?php echo htmlspecialchars($vehicle['description']); ?></p>
                    </div>
                    
                    <div class="detail-seller">
                        <h3>Contact Seller</h3>
                        <div class="seller-info">
                            <div class="seller-item">
                                <div class="seller-label">Dealership</div>
                                <div class="seller-value"><?php echo htmlspecialchars($vehicle['seller']['name']); ?></div>
                            </div>
                            <div class="seller-item">
                                <div class="seller-label">Phone</div>
                                <div class="seller-value"><a href="tel:<?php echo htmlspecialchars($vehicle['seller']['phone']); ?>"><?php echo htmlspecialchars($vehicle['seller']['phone']); ?></a></div>
                            </div>
                            <div class="seller-item">
                                <div class="seller-label">Email</div>
                                <div class="seller-value"><a href="mailto:<?php echo htmlspecialchars($vehicle['seller']['email']); ?>"><?php echo htmlspecialchars($vehicle['seller']['email']); ?></a></div>
                            </div>
                            <div class="seller-item">
                                <div class="seller-label">Address</div>
                                <div class="seller-value"><?php echo htmlspecialchars($vehicle['seller']['address']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Elite Auto Dealership. All rights reserved. Test Site for Web Scraping.</p>
        </div>
    </footer>
</body>
</html>
