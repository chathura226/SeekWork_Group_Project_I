#!/bin/bash

arg1="$1"

if [ "$arg1" = "up" ]; then
    echo "Starting SeekWork !............."
    echo "Running docker compose up --build"
    docker-compose up --build -d
    sleep 5
    echo "SeekWork started successfully!"
    echo "Seekwork running @ : http://localhost/public"
    echo "phpMyAdmin @ http://localhost:8001"
elif [ "$arg1" = "down" ]; then
    echo "Exporting the database !............."
    docker exec -i db mysqldump -uadmin -ppassword --events --routines SeekWorkDB > ../db/SeekWorkDB.sql
    # Wait for a few seconds to allow the export to complete
    sleep 10

    echo "Successfully exported !"
    echo "Ending SeekWork server ....... running docker-compose down"
    docker-compose down
    echo "SeekWork ended successfully!"

else
    echo "Invalid Argument. Use 'up' or 'down'"
fi
