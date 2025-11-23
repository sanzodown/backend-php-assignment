#!/bin/bash

set -e

echo "🧪 Preparing test environment..."
echo "📊 Resetting test database..."

docker-compose exec -T php php bin/console doctrine:database:drop --force --if-exists --env=test --quiet 2>/dev/null || true
docker-compose exec -T php php bin/console doctrine:database:create --env=test --quiet
docker-compose exec -T php php bin/console doctrine:migrations:migrate --no-interaction --env=test --quiet

echo "🧪 Running tests..."
docker-compose exec -T php ./bin/phpunit "$@"
