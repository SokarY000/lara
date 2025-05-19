FROM php:8.2-cli

# تثبيت الاعتمادات المطلوبة
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libcurl4-openssl-dev \
  && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل
WORKDIR /var/www

# نسخ ملفات المشروع
COPY . .

# تثبيت حزم PHP وضبط الصلاحيات
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
  && chown -R www-data:www-data /var/www \
  && chmod -R 755 /var/www

# تعريف المنفذ لتشغيل artisan serve داخلياً
EXPOSE 8000

# تشغيل خادم التطوير الداخلي للـ Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
