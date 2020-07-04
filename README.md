## Initial Project Setup
*   Library for slim 3 skeleton `php composer.phar create-project "codecourse/slender 1.0.2" slimPhpUnitProject`

## Database Setup
*   Library for database model & Eloquent `php composer.phar require illuminate/database`
*   Library for database migrations `php composer.phar require robmorgan/phinx`
*   Create two folders in db directory as `db/migrations` and `db/seeds`
*   Run `vendor/bin/phinx init` - New file will create in our codebase : `phinx.yml`.
    The file stores database credentials and points phinx to the location to migrations and seeder files.
*   Run `vendor/bin/phinx create Create{TableName}Table` to create `TableName` migration files.

## Required Libraries
*   Library for slim validation : `php composer.phar require awurth/slim-validation`
*   Library for php unit : `php composer.phar require phpunit/phpunit`
*   Library for PSR2 convention : `php composer.phar require squizlabs/php_codesniffer` for PSR2
    and install SonarLint for SonarQube.
*   Library for JWT : `php composer.phar require firebase/php-jwt`
    
## Phinx Commands
*   `vendor/bin/phinx create CreateUsersTable`
*   `vendor/bin/phinx migrate -e testing` // Run this command in docker bash.
*   `vendor/bin/phinx rollback -e testing` // Run this command in docker bash.
