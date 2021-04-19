composer-install:
	## Exécute la commande composer install  dans le container php
	## --rm permet d'arrêter le container une fois la commande exécuter
	## -no--deps indique qu'il n'est pas nécessaire de créer le container postgres dont dépend le container PHP.
		docker-compose run --rm --no-deps php bash -ci '/usr/bin/composer install'

init-db:
		## Ici, nous avons besoin du container postgres, il ne faut donc pas ajouter l'option --no-deps
		docker-compose run --rm php bash
		./bin/console doctrine:database:create --if-not-exists &&
		./bin/console doctrine:schema:update --force

	install:
		$(MAKE) composer-install
		$(MAKE) init-db
start:
	docker-compose up -d
stop:
	docker-compose down
