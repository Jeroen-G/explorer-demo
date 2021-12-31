info:
	@echo "\n=== Make commands ===\n"
	@echo "Elastic"
	@echo "    make refresh"

refresh: do-elastic-delete do-elastic-create do-scout-import

do-elastic-delete:
	vendor/bin/sail artisan scout:delete-index cartographers

do-elastic-create:
	vendor/bin/sail artisan scout:index cartographers

do-scout-import:
	vendor/bin/sail artisan scout:import App\\Models\\Cartographer
