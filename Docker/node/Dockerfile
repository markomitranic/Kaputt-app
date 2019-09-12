FROM node:10.16-jessie-slim AS prod
ENV NPM_CONFIG_LOGLEVEL info

USER root
WORKDIR /app

RUN npm install -g yarn

COPY entrypoint.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]

FROM prod AS dev
COPY entrypoint-dev.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]