COMPOSE_FILES=docker-compose.yml
ROOT_USER=root

up:
	@echo "App: STARTING ..."
	@docker-compose -f $(COMPOSE_FILES) up --build -d
	@echo "App: STARTED"

down:
	@echo "App: STOPPING..."
	@docker-compose -f $(COMPOSE_FILES) down
	@echo "App: STOPPED..."

shell:
	docker-compose -f $(COMPOSE_FILES) exec app bash

shell-as-root:
	docker-compose -f $(COMPOSE_FILES) exec --user=$(ROOT_USER) app bash

test:
	docker-compose run --rm app go test --cover

logs: 
	@docker-compose logs -f