.PHONY: clean

site.phar: resources/dic.compiled.php
	box build

resources/dic.compiled.php:
	php bin/dump_container.php

clean:
	-rm resources/dic.compiled.php
	-rm site.phar
