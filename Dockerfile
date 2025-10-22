# Sử dụng image PHP có sẵn Composer và các tiện ích cần thiết
FROM php:8.2-apache

# Cài đặt các gói cần thiết
RUN apt-get update && apt-get install -y \
    git curl zip unzip nodejs npm \
    && docker-php-ext-install pdo pdo_mysql

# Sao chép toàn bộ mã nguồn vào container
COPY . /var/www/html

# Cài đặt Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Chạy Composer install
RUN composer install --no-dev --optimize-autoloader

# Chạy npm install & build (cho Vite)
RUN npm install && npm run build

# Tạo APP_KEY tự động nếu chưa có
RUN php artisan key:generate --force

# Phân quyền cho thư mục storage và bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Mở cổng 80 cho web server
EXPOSE 80

# Chạy Apache
CMD ["apache2-foreground"]
