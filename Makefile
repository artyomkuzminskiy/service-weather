# Makefile

COMPOSE=docker-compose

build:
	$(COMPOSE) build

up:
	$(COMPOSE) up -d

down:
	$(COMPOSE) down

restart:
	make down
	make up

.PHONY: build up down restart

