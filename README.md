# Project BookApp Brainmatics

## How to use:
- Clone `git clone {url-repo}`
- Copy `.env.example` to `.env` and config the database 
- Change `APP_NAME` in .env
- Run `composer install`
- Run `npm install` 
- Run `php artisan key:generate`
- Run `npm run prod` 
- Run `php artisan migrate`
- Run `php artisan storage:link`

## Config Supervisor octane-app.conf
[program:octane-app]
process_name=%(program_name)s_%(process_num)02d
command=sudo php /home/fatkha/training/bookapps-brainmatics/artisan octane:start --server=swoole --port=8000 --host=*
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
startsecs = 0
user=fatkha
redirect_stderr=true
stdout_logfile=/var/log/supervisor/octane-app.log

## haproxy.cfg
global
    maxconn 50000

defaults
    mode http
    timeout connect 10s
    timeout server 10s
    timeout client 10s

frontend http
    bind *:80
    default_backend backendServer

backend backendServer
    server 159.223.70.12 *:8000
