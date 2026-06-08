#!/bin/bash

# Car Dealership Test Site - Setup Script for Ubuntu 25.10
# This script installs all dependencies and configures Apache

set -e

echo "====================================="
echo "Car Dealership Test Site Setup"
echo "====================================="
echo ""

# Update system
echo "[1/5] Updating system packages..."
sudo apt update
sudo apt upgrade -y

# Install Apache2
echo "[2/5] Installing Apache 2.4..."
sudo apt install -y apache2

# Install PHP 8.4
echo "[3/5] Installing PHP 8.4..."
sudo apt install -y php8.4 php8.4-common

# Enable Apache modules
echo "[4/5] Enabling Apache modules..."
sudo a2enmod php8.4
sudo a2enmod rewrite
sudo systemctl restart apache2

# Deploy files
echo "[5/5] Deploying files to Apache document root..."
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
sudo cp -r "$SCRIPT_DIR"/. /var/www/html/
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/

# Create necessary directories
sudo mkdir -p /var/www/html/data
sudo mkdir -p /var/www/html/css
sudo mkdir -p /var/www/html/images
sudo chown -R www-data:www-data /var/www/html/data

echo ""
echo "====================================="
echo "Setup Complete!"
echo "====================================="
echo ""
echo "Access your site at: http://localhost/"
echo ""
echo "Apache status: $(systemctl is-active apache2)"
echo "PHP version: $(php --version | head -n 1)"
echo ""
echo "To start Apache: sudo systemctl start apache2"
echo "To stop Apache: sudo systemctl stop apache2"
echo "To view logs: sudo tail -f /var/log/apache2/access.log"
echo ""
