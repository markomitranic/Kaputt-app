FROM nginx:latest AS prod

ARG SSL_CERTS_PATH
COPY $SSL_CERTS_PATH /etc/nginx/ssl

RUN rm /etc/nginx/conf.d/*
COPY ./Docker/nginx/conf/gzip.conf /etc/nginx/conf.d/gzip.conf
COPY ./Docker/nginx/conf/nginx.conf /etc/nginx/conf.d/nginx.conf
COPY ./Docker/nginx/conf/tls.conf /etc/nginx/conf.d/tls.conf
COPY ./Docker/nginx/conf/kaputt.conf /etc/nginx/conf.d/kaputt.conf
COPY ./Docker/nginx/conf/macura.conf /etc/nginx/conf.d/macura.conf

COPY ./app/ /app/
WORKDIR /app/

FROM prod AS dev
COPY ./Docker/nginx/conf/kaputt-dev.conf /etc/nginx/conf.d/kaputt.conf
RUN rm /etc/nginx/conf.d/tls.conf
