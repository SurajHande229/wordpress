
# Infrastructure Configuration for WordPress Deployment

## 1. Application Deployment
- **Private Subnet**:
  - WordPress application deployed in a private subnet for enhanced security.

- **Bastion Host**:
  - Created a bastion host for SSH access to the application VM.
  - **Security Groups**:
    - Whitelisted the bastion host's security group (SG).
    - Opened only ports **22**, **80**, and **443**.

## 2. Load Balancer Configuration
- **Load Balancer Deployment**:
  - Configured a load balancer (ALB) in front of the application server.

- **Port Configuration**:
  - **Inbound Rules**:
    - Opened ports **80** and **443** for inbound traffic to the ALB.
  - **Application Server SG**:
    - Whitelisted the load balancer’s SG so that only requests from the ALB are served.

- **Listener Configuration**:
  - Configured listeners for **port 80** and **port 443**.
  - Redirected **HTTP (port 80)** traffic to **HTTPS (port 443)**.

## 3. Database Configuration
- **RDS Deployment**:
  - Hosted the database in a private subnet as an RDS instance instead of on the application server.

- **Port Configuration**:
  - Opened port **3306** for inbound traffic.
  - Whitelisted the application server's SG in the database's SG.

## 4. SSL and Security Headers
- **SSL Configuration**:
  - Configured SSL at the load balancer level.
  - Ensured secure communication between the client and the application.

- **Security Headers**:
  - Implemented the following in `nginx.conf`:
    - `server_tokens off;` to hide the NGINX version in response headers.
    - Configured caching and Gzip compression.
    - Added recommended security headers.

## 5. File and Folder Permissions
- **Permissions Settings**:
  - **Folders**: Set to `755`.
  - **Files**: Set to `644`.
  - **wp-config.php**: Set to `400` for enhanced security.

- **Sensitive Information**:
  - `wp-config.php` is not pushed to GitHub as it contains sensitive information such as database credentials.

## 6. Additional Configurations
- **Force SSL in Admin Panel**:
  - Added the following setting in `wp-config.php`:
    ```php
    define('FORCE_SSL_ADMIN', true);
    ```

- **Disable File Editing**:
  - Prevented file editing in the WordPress admin panel by adding:
    ```php
    define('DISALLOW_FILE_EDIT', true);
    ```

- **Volume Encryption**:
  - Encrypted volumes using KMS.

- **Secure Communication**:
  - Enabled SSL for all communication to and from the application.
