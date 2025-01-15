# wordpress

# WordPress Deployment with LEMP Stack and GitHub Actions

This repository contains the setup and configuration for deploying a WordPress website using the LEMP stack (Linux, Nginx, MySQL, PHP) on a Virtual Private Server (VPS). The deployment process is automated using GitHub Actions for Continuous Integration and Continuous Deployment (CI/CD).

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Server Provisioning](#server-provisioning)
3. [Website Configuration](#website-configuration)
4. [GitHub Actions Setup](#github-actions-setup)
5. [Deploying the Website](#deploying-the-website)
6. [Optimizations](#optimizations)
7. [License](#license)

## Prerequisites

Before proceeding, ensure you have:

- A VPS (e.g., DigitalOcean, AWS, Azure) running Ubuntu 22.04.
- A domain name and an SSL certificate (Let's Encrypt is recommended).
- A GitHub account and repository for the project.
- SSH access to the server with proper firewall rules configured.

## Server Provisioning

### 1. Provision a VPS
- Choose a cloud provider (e.g., DigitalOcean, AWS, or Google Cloud).
- Create a new VPS (Droplet in DigitalOcean) with Ubuntu 22.04.
- Set up SSH keys for secure access.
- Configure the firewall to allow traffic on ports 22 (SSH), 80 (HTTP), and 443 (HTTPS).

### 2. Install LEMP Stack

1. **Install Nginx**:
    ```bash
    sudo apt update
    sudo apt install nginx -y
    ```

2. **Install MySQL**:
    ```bash
    sudo apt install mysql-server -y
    sudo mysql_secure_installation
    ```

3. **Install PHP**:
    ```bash
    sudo apt install php-fpm php-mysql php-cli php-curl php-gd php-mbstring php-xml php-zip -y
    ```

### 3. Set Up the Database

1. Log into MySQL:
    ```bash
    sudo mysql -u root -p
    ```

2. Create a database for WordPress:
    ```sql
    CREATE DATABASE wordpress_db;
    CREATE USER 'wp_user'@'localhost' IDENTIFIED BY 'strong_password';
    GRANT ALL PRIVILEGES ON wordpress_db.* TO 'wp_user'@'localhost';
    FLUSH PRIVILEGES;
    EXIT;
    ```

## Website Configuration

### 1. Install WordPress

1. Navigate to the web root:
    ```bash
    cd /var/www/html
    ```

2. Download and extract WordPress:
    ```bash
    sudo wget https://wordpress.org/latest.tar.gz
    sudo tar -xzvf latest.tar.gz
    sudo mv wordpress /var/www/your_domain
    ```

3. Set proper permissions:
    ```bash
    sudo chown -R www-data:www-data /var/www/your_domain
    sudo chmod -R 755 /var/www/your_domain
    ```

### 2. Configure Nginx

1. Create a configuration file for the site:
    ```bash
    sudo nano /etc/nginx/sites-available/your_domain
    ```

2. Add the following Nginx configuration:
    ```nginx
    server {
        listen 80;
        listen [::]:80;
        server_name your_domain.com www.your_domain.com;
    
        root /var/www/your_domain;
        index index.php index.html index.htm;
    
        location / {
            try_files $uri $uri/ /index.php?$args;
        }
    
        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/run/php/php8.1-fpm.sock;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }
    
        location ~ /\.ht {
            deny all;
        }
    }
    ```

3. Enable the site and restart Nginx:
    ```bash
    sudo ln -s /etc/nginx/sites-available/your_domain /etc/nginx/sites-enabled/
    sudo nginx -t
    sudo systemctl restart nginx
    ```

### 3. Enable SSL with Let's Encrypt

1. Install Certbot:
    ```bash
    sudo apt install certbot python3-certbot-nginx -y
    ```

2. Run Certbot to configure SSL:
    ```bash
    sudo certbot --nginx -d your_domain.com -d www.your_domain.com
    ```

## GitHub Actions Setup

### 1. Set Up GitHub Repository

1. Create a GitHub repository named `your_wordpress_site`.
2. Push your WordPress files to this repository:
    ```bash
    git init
    git remote add origin https://github.com/your_username/your_wordpress_site.git
    git add .
    git commit -m "Initial WordPress setup"
    git push -u origin master
    ```

### 2. Create GitHub Actions Workflow

1. Create a `.github/workflows/deploy.yml` file with the following content:
    ```yaml
    name: Deploy WordPress

    on:
      push:
        branches:
          - master

    jobs:
      deploy:
        runs-on: ubuntu-latest

        steps:
        - name: Checkout repository
          uses: actions/checkout@v2

        - name: Copy files to server
          uses: appleboy/scp-action@v0.1.4
          with:
            host: ${{ secrets.SERVER_IP }}
            username: ${{ secrets.USERNAME }}
            key: ${{ secrets.SSH_PRIVATE_KEY }}
            source: ".*"
            target: "/var/www/your_domain"

        - name: Restart Nginx
          run: |
            ssh -i ${{ secrets.SSH_PRIVATE_KEY }} ${{ secrets.USERNAME }}@${{ secrets.SERVER_IP }} "sudo systemctl restart nginx"
    ```

2. Add repository secrets in GitHub:
   - `SERVER_IP`: Your server's IP address.
   - `USERNAME`: Your SSH username (typically `root`).
   - `SSH_PRIVATE_KEY`: Your private SSH key used for authentication.

## Deploying the Website

After setting up the GitHub Actions workflow, every time you push code to the `master` branch, the workflow will automatically:

1. Check out the repository.
2. Copy the files to your VPS.
3. Restart Nginx to serve the updated website.

## Optimizations

1. **Enable Gzip Compression**:
   Add the following to your Nginx config:
   ```nginx
   gzip on;
   gzip_comp_level 6;
   gzip_min_length 256;
   gzip_types text/plain text/css application/javascript application/json application/xml text/xml application/xml+rss text/javascript;
   gzip_vary on;
