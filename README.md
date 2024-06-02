# Deploy laravel project trên Amazon EC2 linux 2023

## Bước 1: Tạo một máy ảo EC2
- Cấu hình SSH, HTTP, HTTPS traffic from anywhere.

## Bước 2: Tạo một RDS kết nối đến EC2

## Bước 3: Chuẩn bị một repository Laravel trên GitHub
- Đảm bảo `.env` đã điều chỉnh `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD` theo đúng như trên RDS.

## Bước 4: Thực hiện các lệnh trên terminal

```sh
ssh -i <path-to-pem> ec2-user@<public_IP>
sudo su
sudo yum update -y
sudo yum install -y httpd
sudo yum install -y git
sudo yum install -y php
sudo yum install -y composer
cd /var/www/html
git clone repo_link
cd repo_name
composer install
```
## Bước 5: Cấu hình Apache
- Mở file cấu hình Apache:
```sh
sudo nano /etc/httpd/conf/httpd.conf
```
- Thêm các dòng sau vào file:
```sh
Alias / /var/www/html/repo_name/public/
<Directory "/var/www/html/repo_name/public">
    AllowOverride All
    Order allow,deny
    allow from all
</Directory>
```
- Cài đặt PHP MySQL extension:
```sh
sudo yum install php-mysqlnd
php artisan migrate
```
- Tạo file cấu hình Apache cho Laravel:
```sh
sudo nano /etc/httpd/conf.d/laravel.conf
```
- Thêm các dòng sau vào file:
```sh
<VirtualHost *:80>
    ServerName example.com
    DocumentRoot /var/www/html/repo_name/public

    <Directory /var/www/html/repo_name/public>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
## Bước 6: Thiết lập quyền cho các thư mục trong Laravel
```sh
sudo chown -R apache:apache /var/www/html/<repo_name>/storage/logs
sudo chown -R apache:apache /var/www/html/<repo_name>/storage/framework/sessions
sudo chown -R apache:apache /var/www/html/<repo_name>/storage/framework/views
sudo mkdir -p /var/www/html/<repo_name>/storage/framework/cache/data
sudo chmod -R 775 /var/www/html/<repo_name>/storage/framework/cache
sudo chown -R apache:apache /var/www/html/<repo_name>/storage/framework/cache
```