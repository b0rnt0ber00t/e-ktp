# e-ktp

## requirement
- composer >= 1.10.1
- php >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## config
> .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=root
DB_PASSWORD=Pa$$w0rd!
```
> simbolic link (linux/unix)
```bash
ln -s $PWD/e-ktp/public/assets/img/user/profile $PWD/face-detection/img
```
> windows
```bash
note: create shortcut from 'e-ktp/public/assets/img/user/profile' directory to 'face-detection/img'
```

## Install
> web #laravel
```bash
git clone https://github.com/b0rnt0ber00t/e-ktp.git
cd ektp && composer install
php artisan key:generate && php artisan migrate:fresh --seed
php artisan serve
```

> face detection
```bash
git clone https://github.com/b0rnt0ber00t/face-detection.git
cd face-detection && pip install -r requirement.txt
python main.py
```

## default
>  url
```text
http://127.0.0.1:8000/
```
> email:password admin
```text
admin@admin.com:password
```
