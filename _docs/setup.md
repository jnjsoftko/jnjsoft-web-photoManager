## local sites

user: master.vw
password: V*******!
email: jnjsoft.**@gmail.com

## .env

* .env 사용

### composer 설치

- https://kinsta.com/blog/install-composer/

#### macos

```sh
# install php 
brew install php

# download
sudo php -r "copy('https://getcomposer.org/installer','composer-setup.php');"

# install globally
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

#### hpdotenv

```sh
$ cd "/Users/youchan/Local Sites/photomanager/app/public/photo-man"
$ composer require vlucas/phpdotenv
```

#### load dotenv

> env.php

```php
  if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
  }

  require_once ABSPATH . 'vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable(ABSPATH);
  $dotenv->load();
  $photo_dir = trim($_ENV['PHOTO_DIR']);
  print_r(ABSPATH . 'vendor/autoload.php')
  print_r($photo_dir)
```



