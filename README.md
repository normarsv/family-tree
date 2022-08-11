<h1 align="center">
    Wordpress Basic Usage <img src="https://camo.githubusercontent.com/36eee4ce4f3ee9009871bb3ccbe08bee75fe262e2614b8d3a511fadcdef37e73/68747470733a2f2f63646e2e7261776769742e636f6d2f4d7572686166536f75736c692f6e67782d776f726470726573732f316238636563306130343132656230393835343566646233646635653835643832346534343038622f6173736574732f6c6f676f2e737667" height="40px" title="Wordpress" alt="Wordpress icon" class="aa30d277 pl3" data-nosnippet="true">
</h1>

<p align="center">
  Crafted by Normars for the World
</p>

## <img src="https://github.com/amido/azure-vector-icons/blob/master/renders/server-rack.png?raw=true" height="25px" title="Wordpress" alt="Wordpress icon" class="aa30d277 pl3" data-nosnippet="true"> Requirements for Server

- NGINX
- PHP 7.4
- PHP FPM
- MYSQL
- WP-CLI

Command lines to run from SSH to install everything above

```
sudo apt-get update
sudo apt install nginx
sudo apt install php7.4
sudo apt install php7.4-fpm
sudo apt install php7.4-mysql
```

WP-CLI command lines to run on terminal

```
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
wp help cache
```

## <img src="https://github.com/amido/azure-vector-icons/blob/master/renders/unidentified-code-object-ufo.png?raw=true" height="25px" title="Wordpress" alt="Wordpress icon" class="aa30d277 pl3" data-nosnippet="true"> Run WP Locally

- <a href="https://laravel.com/docs/8.x/valet"> Laravel Valet </a>
- PHP 7.4
- MYSQL
- WP-CLI

1) Create new database <img src="https://raw.githubusercontent.com/amido/azure-vector-icons/master/renders/mysql-database.png" height="20px" title="mysql" alt="mysql icon" class="aa30d277 pl3" data-nosnippet="true">
   ``` 
   mysql -uroot
   create database projectname; 
   ```
2) Clone the file ```wp-config-sample.php``` and change the name to ```wp-config.php```

3) Edit data to match your database name, user and permissions
4) Enter to ```wp-content/themes/"name-of-the-theme"```
5) Run ```npm install && npm run dev```
6) Run ```npm run watch```
7) Done

## <img src="https://github.com/amido/azure-vector-icons/blob/master/renders/batch-services.png?raw=true" height="25px" title="Wordpress" alt="Wordpress icon" class="aa30d277 pl3" data-nosnippet="true"> Folders Structure


    ├── 📂 wp-admin
    ├── 📂 wp-content        # This is the only folder we are going to edit
    │   ├── languages           
    │   ├── plugins          # Make sure only the needed plugins are here and install them
    │   ├── themes           # Here is were we have the themes to use, make sure to keep this folder clean
    │   ├── upgrade        
    │   └── uploads          # This is were all the images are stored, when deploying, make sure to create a .zip to upload to the server
    └── 📂 wp-includes

## <img src="https://github.com/amido/azure-vector-icons/blob/master/renders/notification-topic.png?raw=true" height="25px" title="Wordpress" alt="Wordpress icon" class="aa30d277 pl3" data-nosnippet="true"> Important Stuff for Dev

- Always branch from the develop branch
- The proper naming from the branch should be your initials / the JIRA Issue, example: ```nr/AW-23```
- Make Pull Request from your branch to ```develop``` branch
- Your tech-lead will make sure to merge ```develop``` to ```stage``` so the client can test

<br>

### NEVER PUSH TO ```main``` or ```master``` THAT IS A <strong>NO NO</strong>

