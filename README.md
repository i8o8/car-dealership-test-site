# Car Dealership Test Site

A complete fake car dealership website for testing Chrome Extensions that scrape vehicle data.

## Requirements
- Ubuntu 25.10
- Apache 2.4.64
- PHP 8.4.11
- No database (flat-file JSON)

## Setup Instructions

### 1. Install Dependencies
```bash
sudo apt update
sudo apt install apache2 php8.4 php8.4-common
```

### 2. Enable Apache Modules
```bash
sudo a2enmod php8.4
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### 3. Deploy Files
Clone this repository and copy to Apache:
```bash
git clone https://github.com/i8o8/car-dealership-test-site.git
sudo cp -r car-dealership-test-site/* /var/www/html/
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/
```

### 4. Access the Site
Visit `http://localhost/` in your browser.

## File Structure
```
.
├── index.php           # Homepage with vehicle grid
├── vehicle.php         # Individual vehicle detail page
├── data/
│   └── vehicles.json   # All vehicle data (flat-file)
├── css/
│   └── style.css       # Site styling
├── .htaccess           # Apache configuration
├── setup.sh            # Automated setup script
└── README.md           # This file
```

## Features
- 15 sample vehicles with realistic data
- Responsive grid layout on homepage
- Detailed vehicle pages with multiple photos
- Stock images from Unsplash
- Fake seller information
- Clean HTML structure for easy web scraping
- Data attributes for Chrome Extension targeting
- No database required (flat-file JSON)

## Data Structure

Each vehicle in `data/vehicles.json` contains:
- `id` - Unique identifier
- `year`, `make`, `model`, `trim`
- `price`, `mileage`, `vin`, `stock`
- `description` - Vehicle description
- `photos` - Array of 3-5 image URLs
- `seller` - Contact information (name, phone, email, address)

## Chrome Extension Testing

The site is optimized for web scraping with:
- Semantic HTML structure
- Data attributes on vehicle cards
- RESTful URL structure (`/vehicle.php?id=###`)
- Consistent data formatting
- Multiple photos per vehicle for complex scraping scenarios

## Quick Start (Automated)

```bash
chmod +x setup.sh
./setup.sh
```

This will automatically install all dependencies and deploy the site.

## License

Test site - Free to use for development and testing purposes.
