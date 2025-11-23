#!/bin/bash

set -e

echo "🚀 Initializing project..."

echo "📦 Installing dependencies..."
composer install

echo "🐳 Starting Docker environment (MySQL + PHP)..."
docker-compose up -d --build

echo "⏳ Waiting for services to be ready..."
sleep 5

echo "📊 Creating databases..."
docker-compose exec -T php php bin/console doctrine:database:create --if-not-exists
docker-compose exec -T php php bin/console doctrine:database:create --if-not-exists --env=test

echo "🔄 Running migrations..."
docker-compose exec -T php php bin/console doctrine:migrations:migrate --no-interaction
docker-compose exec -T php php bin/console doctrine:migrations:migrate --no-interaction --env=test

echo "🌱 Loading fixtures..."
docker-compose exec -T php php bin/console doctrine:fixtures:load --no-interaction

echo ""
echo "✅ Project initialized successfully!"
echo "   Access it at: http://localhost:8000"
echo ""
