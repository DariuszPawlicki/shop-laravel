FROM nginx:1.15-alpine

COPY ./docker/nginx/nginx.conf.template /etc/nginx/nginx.conf.template
COPY ./docker/nginx/entrypoint.bash /

RUN chmod +x /entrypoint.bash

EXPOSE 80

ENV NGINX_CGI_SERVER_HOST="php-fpm" \
    NGINX_CGI_SERVER_PORT="9000" \
    NGINX_WORKERS_COUNT="5"

ENTRYPOINT ["/entrypoint.bash"]

CMD ["nginx", "-g", "daemon off;"]
