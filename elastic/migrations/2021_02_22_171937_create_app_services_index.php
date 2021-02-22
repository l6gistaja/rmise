<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateAppServicesIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('app_services', function (Mapping $mapping, Settings $settings) {
            $mapping->text('name');
	    $mapping->keyword('type');
	    $mapping->keyword('sub_type');
	    $mapping->text('description');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('app_services');
    }
}
