# Agency-IT-Task

# 1- installation
    in database
        - create agency-it database 
    in Terminal
        - composer install
        - php artisan migrate --seed
        - php artisan serve

# 2- login as Parent
    Postman Collection 
    - https://app.getpostman.com/run-collection/1655a8cfb1e30c0e11aa?action=collection%2Fimport
    - login Tab with email "supervisor@gmail.com , password: supervisor@gmail.com"
    - login Tab with email "employee1@gmail.com , password: employee1"
    - login Tab with email "employee1@gmail.com , password: employee1"
    - copy the token response 
    
# 3 use Apis 
    - copy the token to authorization tab and switch type to bearer token then paste it

