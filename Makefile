.PHONY: ci test phpunit cs stan psalm

DEFAULT_GOAL := ci

ci: test cs

test: phpunit stan psalm

cs: phpcs

phpunit:
	./vendor/bin/phpunit

phpcs:
	./vendor/bin/phpcs -p -s

stan:
	./vendor/bin/phpstan analyse --no-progress

psalm:
	./vendor/bin/psalm
