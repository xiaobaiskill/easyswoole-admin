FROM twosee/swoole-coroutine:latest

WORKDIR /home/www

ADD . .

RUN composer config -g repo.packagist composer https://packagist.phpcomposer.com

RUN composer install

RUN cp vendor/easyswoole/easyswoole/bin/easyswoole easyswoole

RUN cp App/Config/Database.php.bak App/Config/Database.php 

EXPOSE 9503

CMD ["php","easyswoole","start","produce"]