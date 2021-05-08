#!/bin/bash

dockerize -timeout 60s -wait tcp://${DB_HOST}:${DB_PORT}
