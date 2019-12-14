FROM twosee/swoole-coroutine:latest

WORKDIR /home/www

ADD . .

RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

RUN composer install

RUN cp vendor/easyswoole/easyswoole/bin/easyswoole easyswoole

RUN cp App/Config/Database.php.bak App/Config/Database.php

RUN ln -fs /usr/share/zoneinfo/Asia/Shanghai /etc/localtime

EXPOSE 9503

CMD ["php","easyswoole","start","produce"]