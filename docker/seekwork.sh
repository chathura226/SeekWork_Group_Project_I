#!/bin/bash

arg1="$1"

if [ "$arg1" = "up" ]; then
    echo "Starting SeekWork !............."
    echo "Running docker compose up --build"
    docker-compose up --build -d
    sleep 5
    echo "SeekWork started successfully!"
elif [ "$arg1" = "down" ]; then
    echo "Exporting the database !............."
    docker exec -i docker-db-1 mysqldump -uadmin -ppassword SeekWorkDB > ../db/SeekWorkDB.sql
    # Wait for a few seconds to allow the export to complete
    sleep 10

    echo "Successfully exported !"
    echo "Ending SeekWork server ....... running docker-compose down"
    docker-compose down
    echo "SeekWork ended successfully!"
else
    echo "Invalid Argument. Use 'up' or 'down'"
fi
