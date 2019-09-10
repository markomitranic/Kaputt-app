#!/bin/sh

set -e

# # Clean everything up.
docker-compose -f docker-compose.yaml -f docker-compose-dev.yaml down

# Start anew
docker-compose -f docker-compose.yaml -f docker-compose-dev.yaml build
docker-compose -f docker-compose.yaml -f docker-compose-dev.yaml up --remove-orphans