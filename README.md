# Pardis_API

## Installation


### Basic Requirements

برای شروع به کار این پروژه، لازم است ابتدا ابزارهای زیر روی سیستم شما نصب و تنظیم شده باشد:  

1. PHP
2. MySQL
3. composer  

### Create DataBase

ابتدا لازم است دیتابیس مربوط به این پروژه را در سیستم خود ایجاد کنید. برای این کار میتوانید از دستورات زیر استفاده کنید:  

```bash
mysql -u root -p
```
حال، رمز عبور را وارد کنید. سپس دستورات زیر را به ترتیب اجرا کنید.  

توجه داشته باشید که به جای مقادیر زیر میتوانید نام های دلخواه خود را ثبت کنید:  

```txt
pardis_api   =>   نام دیتابیس
api_user     =>   نام کاربر دیتابیس برای این پروژه
api_password =>   رمز عبور کاربر دیتابیس برای این پروژه
```


```sql
CREATE DATABASE pardis_api CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'api_user'@'localhost' identified by 'api_password';
GRANT ALL on pardis_api.* to 'api_user'@'localhost';
quit
```

### Clone the project repository

با استفاده از دستور زیر آخرین نسخه از سورس کد پروژه را دریافت کنید:  

```bash
git clone https://github.com/hashemi-asl/Pardis_API.git 
```

پس از دریافت سورس کد، مراحل زیر را ادامه دهید:  

```
cd Pardis_API

composer install
```

برای ایجاد جداول دیتابیس دستور زیر را اجرا کنید: 

```
php database\migrations\create_tables.php
```

در صورت تمایل میتوانید با اجرای دستورات زیر، اطلاعات چند کاربر و کتاب فرضی را به دیتابیس اضافه کنید: 

```
php database\seeds\users_seed.php
php database\seeds\books_seed.php
```

و در نهایت با دستور زیر وب سرور را اجرا کنید:  

```
php -S 127.0.0.1:8080
```

با اجرا دستور بالا مراحل نصب و راه اندازی پروژه تکمیل میشود.  

برای آشنایی دقیقتر با API پروژه فایل `pardis_api.postman_collection.json` به برنامه `Postman` ایمپورت کنید