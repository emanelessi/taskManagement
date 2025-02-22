# استخدام صورة PHP مع Apache
FROM php:8.2-apache

# تثبيت الإضافات المطلوبة لـ Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ المشروع إلى المجلد الرئيسي داخل الحاوية
WORKDIR /var/www/html
COPY . .

# تثبيت الحزم عبر Composer
RUN composer install --no-dev --optimize-autoloader

# ضبط أذونات التخزين
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# تعيين نقطة الدخول
CMD ["apache2-foreground"]
