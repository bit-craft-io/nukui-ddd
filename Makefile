# ========================================
# migrate
# ----------------------------------------
.PHONY: migrate-all
migrate-all: migrate-app migrate-log migrate-test

.PHONY: migrate-app
migrate-app:
	@$(MAKE) \
	DB_NAME=app_db \
	DB_PATH=database/migrations \
	migrate

.PHONY: migrate-test
migrate-test:
	@$(MAKE) \
	DB_NAME=test_db \
	DB_PATH=database/migrations \
	migrate

.PHONY: migrate-log
migrate-log:
	@$(MAKE) \
	DB_NAME=log_db \
	DB_PATH=database/migrations/log \
	migrate

.PHONY: migrate
migrate:
	DB_DATABASE=$(DB_NAME) php artisan migrate --path=$(DB_PATH)

# ========================================
# migrate:reset
# ----------------------------------------
migrate-all-reset: migrate-app-reset migrate-log-reset migrate-test-reset

.PHONY: migrate-app-reset
migrate-app-reset:
	@$(MAKE) \
	DB_NAME=app_db \
	DB_PATH=database/migrations \
	migrate-reset

.PHONY: migrate-test-reset
migrate-test-reset:
	@$(MAKE) \
	DB_NAME=test_db \
	DB_PATH=database/migrations \
	migrate-reset

.PHONY: migrate-log-reset
migrate-log-reset:
	@$(MAKE) \
	DB_NAME=log_db \
	DB_PATH=database/migrations/log \
	migrate-reset

.PHONY: migrate-reset
migrate-reset:
	DB_DATABASE=$(DB_NAME) php artisan migrate:reset --path=$(DB_PATH)

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
