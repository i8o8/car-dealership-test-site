<?php
// Homepage - Display all vehicles in a grid

// Load vehicle data
$vehiclesJson = file_get_contents(__DIR__ . '/data/vehicles.json');
$vehicles = json_decode($vehiclesJson, true);

if (!$vehicles) {
    $vehicles = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Auto Dealership - Find Your Perfect Car</title>
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
            <h2 style="margin: 2rem 0 1rem 0; color: #1e3c72; font-size: 1.8rem;">Featured Vehicles</h2>
            
            <div class="vehicle-grid">
                <?php foreach ($vehicles as $vehicle): ?>
                    <a href="/vehicle.php?id=<?php echo htmlspecialchars($vehicle['id']); ?>" class="vehicle-card" data-vehicle-id="<?php echo htmlspecialchars($vehicle['id']); ?>" data-vin="<?php echo htmlspecialchars($vehicle['vin']); ?>">
                        <img src="<?php echo htmlspecialchars($vehicle['photos'][0]); ?>" alt="<?php echo htmlspecialchars($vehicle['year'] . ' ' . $vehicle['make'] . ' ' . $vehicle['model']); ?>">
                        <div class="vehicle-card-content">
                            <div class="vehicle-card-header">
                                <div class="vehicle-year"><?php echo htmlspecialchars($vehicle['year']); ?></div>
                                <div class="vehicle-title"><?php echo htmlspecialchars($vehicle['make'] . ' ' . $vehicle['model']); ?></div>
                            </div>
                            <div class="vehicle-price">$<?php echo number_format($vehicle['price']); ?></div>
                            <div class="vehicle-details">Mileage: <?php echo number_format($vehicle['mileage']); ?> mi</div>
                            <div class="vehicle-vin">VIN: <?php echo htmlspecialchars($vehicle['vin']); ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Elite Auto Dealership. All rights reserved. Test Site for Web Scraping.</p>
        </div>
    </footer>
</body>
</html>
