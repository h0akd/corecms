## Installation

Bước 1: Cài đặt laravel.

    Đọc thêm tài liệu trên http://laravel.com/docs/quick

Bước 2: Cài đặt core cms và sentry
    Thêm 2 dòng sau vào mục required trong composer.json
    
    "require": {
        "h0akd/corecms": "1.0.*",
    },

Bước 3: Gõ dòng lện sau
    
    composer update

Bước 4: Đăng ký service provider và alias. Mờ config/app.php lên
    
    'H0akd\Corecms\CorecmsServiceProvider',
    'Cartalyst\Sentry\SentryServiceProvider'

Bước 5: Chạy các lện sau:
    
    php artisan corecms:install    

Bước 6: Tạo các user

