CalendarBundle demo project

1. Clone the project.
2. Run `composer install`.
3. Install frontend dependencies. If you have Yarn installed, you can simply do `yarn`.
4. Dump javascript routing `php app/console fos:js-routing:dump --format=json`
5. Create the database `php app/console doctrine:database:create` (provided you user has the right privileges)
6. Update the schema `php app/console doctrine:schema:update --force`

There are no saved events at the moment.