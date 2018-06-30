# PHP 7.2 image with php cli
FROM ubuntu:xenial

# Set the env variable DEBIAN_FRONTEND to noninteractive
ARG LC_ALL=C.UTF-8

# Install essential packages
RUN set -e; \
    apt-get update && apt-get install software-properties-common -y && \
    add-apt-repository -y ppa:ondrej/php && \
    apt-get update && apt-get install -y --no-install-recommends \
    curl \
    git \
    locales \
    ca-certificates \
    curl \
    zip \
    php-pear \
    # install libmaxminddb
    libmaxminddb0 libmaxminddb-dev mmdb-bin \
    # install PHP
    php7.2 \
    php7.2-common php7.2-json php7.2-opcache php7.2-readline \
    php7.2-cli \
    php7.2-curl \
    php7.2-dev \
    php7.2-intl \
    php7.2-json \
    php7.2-mbstring \
    php7.2-oauth \
    php7.2-opcache \
    php7.2-soap \
    php7.2-xml \
    php7.2-zip \
    php7.2-yaml \
    # mongodb extension requirement
    pkg-config libssl-dev \
    jq && \
    # xdebug log dir
    test ! -e /var/log/xdebug && mkdir /var/log/xdebug && chown root:root /var/log/xdebug && \
    curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin  && \
    composer global require hirak/prestissimo && \
    # Set locales
    locale-gen en_US && \
    # Set up CA root certificates
    mkdir -p /etc/ssl/certs/ && update-ca-certificates --fresh && \
    # Clean
    apt-get purge -y --auto-remove && apt-get clean all && rm -rf /var/lib/apt/ && php -v

CMD /sbin/my_init
