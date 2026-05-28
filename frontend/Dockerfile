# Stage 1: Build
FROM node:20-alpine AS builder

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# Stage 2: Runner with Nginx
FROM node:20-alpine AS runner

RUN apk add --no-cache nginx supervisor

WORKDIR /app

ENV NODE_ENV=production
ENV PORT=3000
ENV HOSTNAME=127.0.0.1

RUN addgroup --system --gid 1001 nodejs \
    && adduser --system --uid 1001 nextjs

# Copy standalone Next.js build
COPY --from=builder --chown=nextjs:nodejs /app/.next/standalone ./
COPY --from=builder --chown=nextjs:nodejs /app/.next/static ./.next/static
COPY --from=builder --chown=nextjs:nodejs /app/public ./public

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf

RUN mkdir -p /var/log/supervisor /run/nginx

EXPOSE 80

CMD ["supervisord", "-c", "/etc/supervisord.conf"]
