FROM jbboynton/wp_docker_base:latest

COPY app /var/www/app
COPY config /var/www/config
COPY vendor /var/www/vendor

USER root
RUN chown -R www-data:www-data /var/www
