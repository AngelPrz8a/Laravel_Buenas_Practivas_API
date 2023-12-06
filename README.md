
![Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)


## Recipes using API and Laravel 

Creating an API for Recipes witn their tags and categories, developing different versions and testing it with laravel telescope

## Tech Stack

**Server:** [Laravel](https://laravel.com/), [Laravel Telescope](https://laravel.com/docs/10.x/telescope)


## Installation

1. Clone this repository.
2. Navegate to the project directory
3. Run `composer install` to install the dependencies.
4. Configure your environment variables.
5. Run `php artisan key:generate` to generate an application key.
6. Run `php artisan migrate` to create the tables in your database.
7. Run `php artisan db:seed` to fill the database with test data.


    
## API Reference

#### Category

| Type | Path | Description | Return
| :- | :- | :- | :-
| `GET` | `/api/v1/categories` | All categories that exist | id, type, name
| `GET` | `/api/v1/categories/${id}` | A specific category | id, type, name, recipes

#### Tag

| Type | Path | Description | Return
| :- | :- | :- | :-
| `GET` | `/api/v1/tags` | All tags that exist | id, type, name
| `GET` | `/api/v1/tags/${id}` | A specific tag | id, type, name, recipes

#### Recipe V1

| Type | Path | Description | Return
| :- | :- | :- | :-
| `GET` | `/api/v1/recipes` | All tags that exist | id, type, attributes
| `GET` | `/api/v1/recipes/${id}` | A specific tag | id, type, name, recipes
| `POST` | `/api/v1/recipes` | Create a new tag | Same data and confirmation
| `PUT` | `/api/v1/recipes/${id}` | Update an existed tag only if the same person who created it| Same data and confirmation
| `DELETE` | `/api/v1/recipes/${id}` | Delete an existed tag only if the same person who created it| Same data and confirmation

#### Recipe V2

| Type | Path | Description | Return
| :- | :- | :- | :-
| `GET` | `/api/v1/recipes` | All tags that exist order Desc | id, type, attributes

## Links

[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://angelprz8a.github.io/Portafolio/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/angelprz8a/)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

