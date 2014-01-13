## Installation

Bước 1: Cài đặt laravel.

    Đọc thêm tài liệu trên http://laravel.com/docs/quick

Bước 2: Cài đặt core cms và sentry
    Thêm 2 dòng sau vào mục required trong composer.json
    
    "require": {
        "h0akd/corecms": "1.0.*",
        "cartalyst/sentry": "2.0.*"
    },

Bước 3: Gõ dòng lện sau
    
    composer update

Bước 4: Đợi cho update xong tiếp tục gõ dòng lện
    
    composer dump-autoload

Bước 5: Đăng ký service provider và alias. Mờ config/app.php lên
    
    'H0akd\Corecms\CorecmsServiceProvider',
    'Cartalyst\Sentry\SentryServiceProvider'

    'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',

Bước 6: Cài đặt database seed để tạo ra admintror user. Hãy cẩn thận thay mật khẩu admin trator ở đây
    
    <?php

        class SentryUserSeeder extends Seeder {

            public function run() {
                DB::table('users')->delete();
                Sentry::getUserProvider()->create(array(
                    'email' => 'administrator',
                    'password' => '123456',
                    'activated' => 1,
                ));

                DB::table('groups')->delete();

                $group = new \H0akd\Corecms\Models\Group();
                $group->title = "Admintrator";
                $group->name = "administrator";
                $group->save();

                $userUser = Sentry::getUserProvider()->findByLogin('administrator');
                $userUser->addGroup(Sentry::getGroupProvider()->findByName('administrator'));
         }

       }

Bước 7 chạy các lện sau:
    
    php artisan asset:publish h0akd/corecms    
    php artisan config:publish h0akd/corecms
    php artisan migrate --package=cartalyst/sentry
    php artisan migrate --package=h0akd/corecms
    php artisan db:seed


