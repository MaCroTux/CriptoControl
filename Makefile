rebuild:

	@if [ "`docker images | grep criptocontrol_cli | wc -l`" = "1" ]; \
		then \
		echo "Remove old image"; \
		docker rmi criptocontrol_cli:latest; \
	fi;
	@docker-compose build > /dev/null
	@echo "Build image complete!"
	@docker run                                                                                                        \
        --rm                                                                                                           \
        --name criptocontrol_cli                                                                                       \
        -v ~/proyect/CriptoControl:/data                                                                               \
        criptocontrol_cli:latest                                                                                       \
        bash -c "                                                                                                      \
            cd data &&                                                                                                 \
            composer install                                                                                           \

up:

	@if [ "`docker images | grep criptocontrol_cli | wc -l`" = "0" ]; \
		then \
		echo "Building image!" \
		docker-compose build > /dev/null; \
	else \
	    echo "Environment already Found"; \
	fi;

init:

	@docker run                                                                                                        \
        --rm                                                                                                           \
        --name criptocontrol_cli                                                                                       \
        -v ~/proyect/CriptoControl:/data                                                                               \
        criptocontrol_cli:latest                                                                                       \
        bash -c "                                                                                                      \
            cd data &&                                                                                                 \
             composer install                                                                                          \
        "

composer-install:

	@docker run                                                                                                        \
	    --rm                                                                                                           \
	    --name criptocontrol_cli                                                                                       \
	    -v ~/proyect/CriptoControl:/data                                                                               \
	    criptocontrol_cli:latest                                                                                       \
	    bash -c "                                                                                                      \
	        cd data &&                                                                                                 \
	        composer install                                                                                           \
        "

test:

	@docker run                                                                                                        \
        --rm                                                                                                           \
        --name criptocontrol_cli                                                                                       \
        -v ~/proyect/CriptoControl:/data                                                                               \
        criptocontrol_cli:latest                                                                                       \
        bash -c "cd data && vendor/bin/phpunit"
