#!/bin/bash
# Thiết lập các giá trị cấu hình PHP
echo "upload_max_filesize = 10M" >> /usr/local/etc/php/conf.d/uploads.ini
echo "post_max_size = 10M" >> /usr/local/etc/php/conf.d/uploads.ini

# Chạy lệnh khởi động mặc định của PHP
exec apache2-foreground
