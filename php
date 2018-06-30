#!/usr/bin/env bash

docker run                                                                                                             \
    --rm                                                                                                               \
    --name criptocontrol_cli                                                                                           \
    -v ~/proyect/CriptoControl:/data                                                                                   \
    -w /data                                                                                                           \
    criptocontrol_cli:latest                                                                                           \
    php $@
