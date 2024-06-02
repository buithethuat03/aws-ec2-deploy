# deploy

- Tạo một máy ảo EC2 (cấu hình SSH, HTTP, HTTPS traffic from anywhere)
- Tạo một RDS kết nối đến EC2
- Chuẩn bị một repository laravel trên github, .env có điều chỉnh DB_HOST, DB_USERNAME, DB_PASWORD theo đúng như trên RDS


ssh -i <path-to-pem> ec2-user@<public_IP>

sudo su
sudo yum update -y
sudo yum install -y httpd
sudo yum install -y git
sudo yum install -y php
sudo yum install -y composer

cd /var/www/html
git clone <repo_link>
cd <repo_name>
composer install

sudo nano /etc/httpd/conf/httpd.conf

(viết vào cuối file)

Alias / /var/www/html/<repo_name>/public/
<Directory "/var/www/html/<repo_name>/public">
    AllowOverride All
    Order allow,deny
    allow from all
</Directory>



sudo yum install php-mysqlnd
php composer migrate

sudo nano /etc/httpd/conf.d/laravel.conf
<VirtualHost *:80>
    ServerName example.com
    DocumentRoot /var/www/html/repo_name/public

    <Directory /var/www/html/project_folder_name/public>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>



sudo chown -R apache:apache /var/www/html/<repo_name>/storage/logs
sudo chown -R apache:apache /var/www/html/<repo_name>/storage/framework/sessions
sudo chown -R apache:apache /var/www/html/<repo_name>/storage/framework/views
sudo mkdir -p /var/www/html/<repo_name>/storage/framework/cache/data
sudo chmod -R 775 /var/www/html/<repo_name>/storage/framework/cache
sudo chown -R apache:apache /var/www/html/<repo_name>/storage/framework/cache



