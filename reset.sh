#!/bin/bash

echo "🛑 Stopping all containers..."
docker stop php-assignment 2>/dev/null || true
docker rm php-assignment 2>/dev/null || true
docker-compose down -v --remove-orphans 2>/dev/null || true

echo "🗑️ Removing Docker images and build cache..."
docker rmi backend-php-assignment-main-php 2>/dev/null || true
docker builder prune -f 2>/dev/null || true

echo "📦 Cleaning vendor and cache..."
rm -rf vendor/ 2>/dev/null || true
rm -rf var/cache/* 2>/dev/null || true

echo ""
echo "✅ Everything cleaned! Fresh start ready"
echo ""

