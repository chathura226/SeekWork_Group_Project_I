-- Grant all privileges to the 'admin' user on all databases.--
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' WITH GRANT OPTION;


above should be in a init.sql file in a volume that maps to mysql 'docker-entrypoint-initdb.d' so 
that it have necessary access to export
