# ========================================
# composer
# ----------------------------------------
COMPOSER_ARGS := $(filter-out composer,$(MAKECMDGOALS))

.PHONY: composer
composer:
	composer $(COMPOSER_ARGS)

# 必須のおなじない
%:
	@:

# ========================================
# artisan
# ----------------------------------------
ARTISAN_ARGS := $(filter-out artisan,$(MAKECMDGOALS))

.PHONY: artisan
artisan:
	php artisan $(ARTISAN_ARGS)

# 必須のおなじない
%:
	@:

# ========================================
# laravel
# ----------------------------------------
.PHONY: laravel-clean
laravel-clean:
	chown -R 1000:1000 /var/www/source
	chmod -R 777 /var/www/source
	rm -rf storage/framework/cache/*

	@$(MAKE) artisan config:clear
	@$(MAKE) artisan cache:clear
	@$(MAKE) artisan view:clear
	@$(MAKE) artisan optimize:clear
	@$(MAKE) composer dump-autoload
	@$(MAKE) job-restart

.PHONY: laravel-reset
laravel-reset:
	@$(MAKE) --no-print-directory migrate-fresh-all
	@$(MAKE) --no-print-directory migrate-all
	@$(MAKE) --no-print-directory migrate-seeder-dev

# ========================================
# migrate
# ----------------------------------------
.PHONY: migrate-all
migrate-all: migrate-app migrate-log migrate-test

.PHONY: migrate-app
migrate-app:
	@$(MAKE) migrate DB_NAME=app_db DB_PATH=database/migrations

.PHONY: migrate-test
migrate-test:
	@$(MAKE) migrate DB_NAME=test_db DB_PATH=database/migrations

.PHONY: migrate-log
migrate-log:
	@$(MAKE) migrate DB_NAME=log_db	DB_PATH=database/migrations/log

.PHONY: migrate
migrate:
	DB_DATABASE=$(DB_NAME) php artisan migrate --path=$(DB_PATH)

# ========================================
# seeder
# ----------------------------------------
.PHONY: migrate-seeder-dev
migrate-seeder-dev:
	@$(MAKE) migrate-seeder DB_NAME=app_db SD_NAME=DevMaster
	@$(MAKE) migrate-seeder DB_NAME=app_db SD_NAME=DevUser
	@$(MAKE) migrate-seeder DB_NAME=log_db SD_NAME=DevLog

.PHONY: migrate-seeder
migrate-seeder:
	DB_DATABASE=$(DB_NAME) php artisan db:seed $(SD_NAME)

# ========================================
# migrate:reset
# ----------------------------------------
migrate-all-reset: migrate-app-reset migrate-log-reset migrate-test-reset

.PHONY: migrate-app-reset
migrate-app-reset:
	@$(MAKE) migrate-reset DB_NAME=app_db DB_PATH=database/migrations

.PHONY: migrate-test-reset
migrate-test-reset:
	@$(MAKE) migrate-reset DB_NAME=test_db DB_PATH=database/migrations

.PHONY: migrate-log-reset
migrate-log-reset:
	@$(MAKE) migrate-reset DB_NAME=log_db DB_PATH=database/migrations/log

.PHONY: migrate-reset
migrate-reset:
	DB_DATABASE=$(DB_NAME) php artisan migrate:reset --path=$(DB_PATH)

# ========================================
# migrate-fresh
# ----------------------------------------
DB_NAME_ARGS := $(filter-out migrate-fresh,$(MAKECMDGOALS))

.PHONY: migrate-fresh
migrate-fresh:
	DB_DATABASE=$(DB_NAME_ARGS) php artisan migrate:fresh

# 必須のおなじない
%:
	@:

.PHONY: migrate-fresh-all
migrate-fresh-all:
	@$(MAKE) migrate-fresh app_db
	@$(MAKE) migrate-fresh test_db
	@$(MAKE) migrate-fresh log_db

# ========================================
# migrate:reset
# ----------------------------------------
# @note 【開発用】Job変更時にソースコードを自動で再読み込みする（queue:restart不要）
.PHONY: job-restart-dev
job-restart-dev:
	php artisan queue:listen

.PHONY: job-restart
job-restart:
	php artisan queue:restart

.PHONY: job-work
job-work:
	php artisan queue:work
