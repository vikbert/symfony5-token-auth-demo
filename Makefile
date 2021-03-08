SHELL := /bin/bash

help:
	# shellcheck disable=SC2046
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$|(^#--)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m %-43s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m #-- /[33m/'

.PHONY: help
.DEFAULT_GOAL := help

#-- db
db-init: ## init the database
	symfony console doctrine:database:create -n
	symfony console doctrine:schema:create -n
	symfony console doctrine:fixtures:load -n
db-update: ## update the database
	symfony console make:migration
	symfony console doctrine:migrations:migrate -n
	symfony console doctrine:fixtures:load -n
