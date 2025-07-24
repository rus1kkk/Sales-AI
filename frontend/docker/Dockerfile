FROM node:lts-alpine AS base
WORKDIR /frontend

# development stage
FROM base AS development
EXPOSE 3000

# build stage
FROM base AS build-stage
COPY ./package*.json ./
RUN npm install
COPY . .
RUN npm run build

# production stage
FROM nginx:stable-alpine AS production
COPY --from=build-stage /frontend/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]