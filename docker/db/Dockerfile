# Use an official PHP image as the base
FROM mysql:latest

#to give permission to read (otherwise in windows env , site wont work)
RUN chmod -R +rx /docker-entrypoint-initdb.d
