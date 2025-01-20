@echo off
cd C:\xampp\htdocs\laravelkasir
php artisan schedule:run > C:\xampp\htdocs\laravelkasir\storage\logs\scheduler.log 2>&1
