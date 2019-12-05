FROM centos:7.5.1804

RUN yum -y install wget

RUN useradd -r -s /sbin/nologin php-fpm

WORKDIR /tmp
COPY ./php-7.2.25.tar.gz php-7.2.25.tar.gz
#RUN wget https://www.php.net/distributions/php-7.2.25.tar.gz
RUN tar zxvf php-7.2.25.tar.gz

WORKDIR /tmp/php-7.2.25

RUN yum -y install libxml2 libxml2-devel openssl openssl-devel curl-devel libjpeg-devel libpng-devel freetype-devel libmcrypt-devel libxslt libicu-devel libxslt-devel autoconf gcc gcc-c++

RUN ./configure \
	--prefix=/usr/local/php-7.2.25 \
	--with-mhash \
	--with-openssl \
	--with-config-file-path=/usr/local/php-7.2.25/etc \
	--disable-short-tags \
	--enable-fpm \
	--with-fpm-user=php-fpm \
	--with-fpm-group=php-fpm \
	--enable-xml \
	--with-libxml-dir \
	--enable-bcmath \
	--enable-calendar \
	--enable-intl \
	--enable-mbstring \
	--enable-pcntl \
	--enable-shmop \
	--enable-soap \
	--enable-sockets \
	--enable-zip \
	--enable-mbregex \
	--enable-mysqlnd \
	--enable-mysqlnd-compression-support \
	--with-mysqli=mysqlnd \
	--with-pdo-mysql=mysqlnd \
	--with-gd \
	--enable-ftp \
	--with-curl \
	--with-xsl \
	--with-iconv \
	--with-freetype-dir \
	--with-jpeg-dir \
	--with-png-dir \
	--with-zlib \
	--enable-sysvsem \
	--enable-inline-optimization \
	--with-xmlrpc \
	--with-gettext && make -j 4 && make install

RUN ln -s /usr/local/php-7.2.25/ /usr/local/php && \
	ln -s /usr/local/php/bin/php /usr/local/bin && \
	ln -s /usr/local/php/sbin/php-fpm /usr/local/sbin && \ 
	ln -s /usr/local/php/bin/phpize /usr/local/bin && \
	ln -s /usr/local/php/bin/pecl /usr/local/bin 

RUN cp ./php.ini-development ./php.ini-production /usr/local/php/etc && \
	cp /usr/local/php/etc/php.ini-development /usr/local/php/etc/php.ini && \
	cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf && \
	cp /usr/local/php/etc/php-fpm.d/www.conf.default /usr/local/php/etc/php-fpm.d/www.conf 

RUN ln -s /usr/local/php/etc/php.ini /usr/local/etc/ && \
	ln -s /usr/local/php/etc/php-fpm.conf /usr/local/etc/ && \
	ln -s /usr/local/php/etc/php-fpm.d/www.conf /usr/local/etc/
 
RUN php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');" && \
	php composer-setup.php && \
	php -r "unlink('composer-setup.php');" && \
	mv composer.phar /usr/local/bin/composer 

COPY ./swoole-4.3.5.tgz swoole-4.3.5.tgz
#RUN pecl download http://pecl.php.net/get/swoole-4.3.5.tgz
RUN tar zxvf swoole-4.3.5.tgz && \
	cd swoole-4.3.5 && \
	phpize && \
	./configure --with-php-config=/usr/local/php/bin/php-config && make && make install

RUN echo "extension=swoole.so" >> /usr/local/php/etc/php.ini
RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

WORKDIR /home/www
ADD . .
RUN composer install
RUN cp vendor/easyswoole/easyswoole/bin/easyswoole easyswoole
RUN cp App/Config/Database.php.bak App/Config/Database.php 


CMD ["php","easyswoole","start","produce"]





