# Docker Compose
# --------------

run:
	docker-compose up -d --build
	docker exec -it app /bin/bash -c "wp plugin deactivate sucuri-scanner; wp plugin activate query-monitor"

stop:
	docker-compose stop

clean:
	docker-compose stop
	docker-compose rm -v --force

restart:
	docker-compose stop
	docker-compose up -d --build
	docker exec -it app /bin/bash -c "wp plugin deactivate sucuri-scanner; wp plugin activate query-monitor"

reset:
	@docker ps -a -q | xargs docker rm -f
	@docker images -q | xargs docker rmi -f

sleep:
	sleep 20

pull_base:
	docker-compose stop
	docker-compose rm -v --force
	docker pull jbboynton/wp_docker_base:latest
	docker-compose up -d --build

wp_log:
	docker logs --tail 50 --timestamps app

db_log:
	docker logs --tail 50 --timestamps mysql

phpmyadmin_log:
	docker logs --tail 50 --timestamps phpmyadmin

https_log:
	docker logs -f --tail 50 --timestamps https_proxy

wp_bash:
	docker exec -it app /bin/bash

db_bash:
	docker exec -it mysql /bin/bash -c "mysql -ubc_marine_canvas_user -pPC70XoPbxi9SSWkDH4qPTlk9BPugPtPr -f bc_marine_canvas_db"

phpmyadmin_bash:
	docker exec -it phpmyadmin /bin/bash

https_bash:
	docker exec -it https_proxy /bin/bash

# MySQL
# -----

mysql-restore:
	docker run -i -v /dump:/dump --link mysql:db --net ops_default --rm mariadb:latest sh -c 'exec mysql -hdb -ubc_marine_canvas_user -pPC70XoPbxi9SSWkDH4qPTlk9BPugPtPr -f bc_marine_canvas_db < /dump/bc_marine_canvas.sql'

mysql-dump:
	docker exec mysql sh -c 'exec mysqldump bc_marine_canvas_db -ubc_marine_canvas_user -pPC70XoPbxi9SSWkDH4qPTlk9BPugPtPr' > /dump/bc_marine_canvas.sql
