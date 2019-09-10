#!/bin/sh

set -e

# # Clean everything up.
docker-compose down

# Start anew
docker-compose build
docker-compose up -d --remove-orphans