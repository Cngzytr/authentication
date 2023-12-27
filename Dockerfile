FROM debian:buster-slim

WORKDIR /var/www/html/
#COPY composer.lock composer.json /var/www/

ENV DEBIAN_FRONTEND noninteractive
ENV APT_KEY_DONT_WARN_ON_DANGEROUS_USAGE=1
ENV NODE_VERSION=12.14.0
RUN apt-get update && \
    apt-get install wget curl ca-certificates rsync -y
RUN wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.33.2/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" &&  nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
RUN cp /root/.nvm/versions/node/v${NODE_VERSION}/bin/node /usr/bin/
RUN cp /root/.nvm/versions/node/v${NODE_VERSION}/bin/npm /usr/bin/
RUN /root/.nvm/versions/node/v${NODE_VERSION}/bin/npm install  leasot@latest -g

RUN apt-get update --fix-missing \
	&& apt-get upgrade -y \
	&& apt-get dist-upgrade -y \
    && apt-get -y install apt-transport-https wget gnupg2

RUN wget -q http://packages.sury.org/php/apt.gpg -O- | apt-key add -  
RUN echo "deb http://packages.sury.org/php/ buster main" | tee /etc/apt/sources.list.d/php.list 
RUN apt-get update

RUN	apt-get install -y build-essential \
    nginx curl \
    php8.2-common php8.2-cli php8.2-zip php8.2-gd \
    php8.2-iconv php8.2-simplexml php8.2-xmlreader \
    php8.2-fpm php8.2-memcache php8.2-memcached \
    php8.2-mysql php8.2-curl php8.2-mbstring php8.2-xml php8.2-sqlite3 \
    libpng-dev libjpeg62-turbo-dev \
    libfreetype6-dev locales \
    zip jpegoptim optipng pngquant gifsicle \
    vim unzip git telnet mariadb-client 


RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./auth /var/www/html/

#CMD composer install && php artisan key:generate && php artisan cache:clear && composer dump-autoload && service php8.2-fpm start && nginx -g "daemon off;"
CMD php artisan serve --host=0.0.0.0 --port=8000
