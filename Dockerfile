# Su dung hinh anh PHP voi FPM
FROM php:8.0.30-fpm

# Cai dat cac phan mo rong can thiet
RUN docker-php-ext-install mysqli

# Dat thu muc lam viec
WORKDIR /home/web/site/

# Khoi dong php-fpm
CMD ["php-fpm"]
