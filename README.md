# RETRO

Retro is a retrospective tool in a retro look.

## Requirements

This project uses Laravel 9 and needs all of its requirements. [Larave Requirements](https://laravel.com/docs/9.x/deployment#server-requirements).

## Running on Windows

- Run PowerShell
- Navigate to the project
- Enter WSL by running the command `wsl`
- Run `./vendor/bin/sail up -d`

## Using *artisan* on Windows

- You have to be in the CLI of the Docker container running the server
    - One way to do that is by clicking the instance in Docker Desktop the pressing the *CLI* button

## Running DB Migrations and Seeders

From the CLI of the Docker container running the server, run:
- `php artisan migrate`
- then run `php artisan db:seed`
- If you need to rollback the last migration, run `php artisan migrate:rollback`

## Links

- [Jira Board](https://chadiw.atlassian.net/jira/software/projects/RET/boards/2)
- [GitHub Repository](https://github.com/chad83/retro) (This Page :P)
- [Laravel Deployment](https://laravel.com/docs/9.x/deployment#server-requirements)

## License

Retro is an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
