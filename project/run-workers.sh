#!/bin/bash
echo "Bash version ${BASH_VERSION}..."
for i in {1..100}
do
    /usr/local/bin/php /var/www/worker.php &
done