#!/bin/bash

# Ensure containers are up and running
docker-compose up -d

echo "Running migrations..."
docker-compose exec app php artisan migrate

echo "Seeding database..."
docker-compose exec app php artisan db:seed

echo "Creating symbolic link for storage..."
docker-compose exec app php artisan storage:link

echo "Initialization complete!"
