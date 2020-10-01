### 1. Application

| App Name    | Laravel |
| ----------- | ------- |
| App Version | 5.8     |
| PHP Version | 7.3.x   |

### 2. Installation

 - after clone or download from gitlab, run **composer install**
 - copy env from .env.example
 - run **php artisan key:generate**
 - run **php artisan storage:link**
 - set credential database in .env
 - run **php artisan migrate:fresh --seed**

 **The default of setup has store in .env.example**

### 3. Login to CMS Credential

|      Email      | Password |     Role    |
| --------------- | -------- | ----------- |
| admin@email.com | 123456   | Super Admin |

### 4. Note

- This is my template, this template using laravel and jQuery
- I'm using JWT Firebase for tokenization
- I'm using traditional way to create log activity
