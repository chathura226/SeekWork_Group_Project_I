@echo off
set arg1=%1

if "%arg1%" == "up" (
    echo "Starting SeekWork !............."
    echo "Running docker compose up --build"
    docker-compose up --build -d
    timeout /t 5 /nobreak
    echo "SeekWork started successfully!"
)else if "%arg1%" == "down" (
    echo "Exporting the database !............."
    docker exec -i docker-db-1 mysqldump -uadmin -ppassword SeekWorkDB > dump.sql
    rem Wait for a few seconds to allow the export to complete
    timeout /t 10 /nobreak


    echo "Successfully exported !"
    echo "Ending SeekWork server ....... running docker-compose down"
    docker-compose down
    echo "SeekWork ended successfully!"
)else (
    echo "Invalid Argument. Use \'up\' or \'down\'"
)

