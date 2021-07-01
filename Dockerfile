FROM jbboynton/wp_docker_base:latest

COPY app /var/www/app
COPY config /var/www/config
COPY vendor /var/www/vendor

RUN set -ex; \
    touch /var/www/config/.env; \
    touch /var/www/config/path_constants.local.php;

USER root
RUN chown -R www-data:www-data /var/www
