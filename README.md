# Media Tools
1. Create env.php file in includes/inc/
2. Define the following **variables**

>      <?php
>      define("DB_HOST", "DB_HOST_HERE");
>      define("DB_USER", "DB_USER_HERE");
>      define("DB_NAME", "DB_NAME_HERE");
>      define("DB_PASSWORD", "DB_PASSWORD_HERE");
>      define("ENV", "local || prod || dev");
>      define("SITE_URL", "SITE_URL_HERE");

3. Run the following command in the terminal    
>      composer install
>      npm install

4. Run sql file in /includes/sql (optional)

Enjoy Happy Coding! 😁
