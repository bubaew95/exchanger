start:
	docker-compose start
restart:
	docker-compose restart
stop:
	docker-compose stop
update:
	docker-compose restart && cd /sites/reverse-proxy && docker-compose restart
acs:
	docker stop $(docker ps -a -q)
