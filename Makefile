rebuild:

	@if [ "`docker images | grep criptocontrol_cli | wc -l`" = "1" ]; \
		then \
		echo "Remove old image"; \
		docker rmi criptocontrol_cli:latest; \
	fi;
	@docker-compose build > /dev/null
	@echo "Build image complete!"
	@./composer instal                                                                                    \

up:

	@if [ "`docker images | grep criptocontrol_cli | wc -l`" = "0" ]; \
		then \
		echo "Building image!" \
		docker-compose build > /dev/null; \
	else \
	    echo "Environment already Found"; \
	fi;

init:

	@./composer instal

test:

	@./phpunit
