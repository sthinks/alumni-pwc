# install packages
composer install

# clear config file
php artisan config:clear
php artisan clear

# key generate
php artisan key:generate

# create alumni database
php artisan db:create alumni

# create the test database
php artisan db:create alumni_test

# migrate
php artisan migrate:fresh

# create uploads directory and
# give permissions needed
mkdir -p storage/app/public/uploads
chmod -R 777 ./storage
chmod -R 777 ./bootstrap/cache/

# optimize app
php artisan route:cache
php artisan view:cache

# test it
php artisan test

