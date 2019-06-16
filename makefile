phpcs:
	@curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar
	@php phpcs.phar src/

database:
	@sudo mysql -e "update mysql.user set authentication_string=PASSWORD('${PASSWD}') where User='${ROOT}';"
	@sudo mysql -e "update mysql.user set plugin='mysql_native_password';FLUSH PRIVILEGES;"
	@sudo mysql_upgrade -u ${ROOT} -p${PASSWD}
	@sudo mysql -u${ROOT} -p${PASSWD} -e 'CREATE DATABASE IF NOT EXISTS `${PROJECT}`'
	@sudo service mysql restart

environment:
	@sudo apt-get update -q
	@sudo apt-get install -y curl

install:
	@composer create-project --prefer-dist laravel/laravel ${TRAVIS_BUILD_DIR}/${PROJECT}
	@echo DB_PASSWORD=${PASSWD} >> ${TRAVIS_BUILD_DIR}/assets/.env
	@echo DB_USERNAME=${ROOT} >> ${TRAVIS_BUILD_DIR}/assets/.env
	@cp -Rf ${TRAVIS_BUILD_DIR}/assets/. ${TRAVIS_BUILD_DIR}/${PROJECT}
	@cd ${TRAVIS_BUILD_DIR}/${PROJECT} && composer require diplodocker/auth-service
	@cd ${TRAVIS_BUILD_DIR}/${PROJECT} && php artisan key:generate && php artisan jwt:secret && php artisan migrate --force

test:
	@composer dump-autoload
	@cd ${TRAVIS_BUILD_DIR}/${PROJECT} && vendor/bin/phpunit --order-by=defects --stop-on-defect

logs:
	cat ${TRAVIS_BUILD_DIR}/${PROJECT}/storage/logs/laravel.log
