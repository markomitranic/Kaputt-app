FROM node:10.16-jessie-slim AS prod
ENV NPM_CONFIG_LOGLEVEL info

USER root

RUN npm install -g yarn

COPY ./app/nada /app/nada
WORKDIR /app/nada
RUN yarn install

COPY ./Docker/node/entrypoint.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]

FROM prod AS dev
RUN npm install @vue/cli
COPY ./Docker/node/entrypoint-dev.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]