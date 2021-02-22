<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateApplicationsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::create('applications', function (Mapping $mapping, Settings $settings) {
            $mapping->text('name');
	    $mapping->keyword('app_group');
	    $mapping->keyword('app_type');
	    $mapping->text('description');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('applications');
    }
}
