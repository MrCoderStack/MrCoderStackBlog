# mrcoderBlog

git clone https://github.com/FrCoderBlog/mrcoderBlog.git blog
cd blog 
composer install
composer dump-autoload
php artisan key:generate
vim .env
php artisan migrate
php artisan db:seed --class=UsersTableSeeder
php artisan storage:link





