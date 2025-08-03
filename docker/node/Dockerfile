FROM node:18-alpine

WORKDIR /var/www/html/frontend

COPY frontend/package.json ./
RUN npm install

COPY frontend/ ./

CMD ["npm", "run", "dev"]
