<!--
*** To avoid retyping too much info. Do a search and replace for the following:
*** github_username, repo_name
-->

# 🏆 PDRNL Events Registration
<!-- PROJECT SHIELDS -->
![Project Maintenance][maintenance-shield]
[![License][license-shield]](LICENSE.md)

[![GitHub Activity][commits-shield]][commits]
[![GitHub Last Commit][last-commit-shield]][commits]
[![Contributors][contributors-shield]][contributors-url]

[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]

## About

A centralized competition registration platform where all drone racing pilots can register for competitions.

## Development - Get started
<details>
  <summary>Click to expand!</summary>

## Requirements

- [Docker](https://www.docker.com) (and docker-compose v2.x)
- [Composer](https://getcomposer.org)
- [Nginx proxy manager](https://nginxproxymanager.com) (optional)

You can start developing in 2 ways:
### Devcontainers

1. Clone the repository
2. Reopen in container
3. When the container build is finished: `bash init.sh`

### Docker

How to start with this Laravel Docker template:

1. Clone the repository
2. Create a `.env` file and make an symbolic link

```bash
cp ./laravel/.env.example ./laravel/.env
ln -s laravel/.env .env
```

3. Inside the `.env` file give the following variables a value
    - `APP_NAME`
    - `DOCKER_IMAGE_NAME`
    - `DB_HOST`
    - `DB_DATABASE`
    - `DB_USERNAME`
    - `DB_PASSWORD`
    - `DB_ROOT_PASSWORD`

4. Change the port numbers according to your situation
    - `DB_PORT`
    - `HOST_HTTP_PORT`
    - `HOST_HTTPS_PORT`

> NOTE: if you are going to use your Laravel environment in combination with a domain name and SSL, change the `APP_ENV` to **production**.

5. Install the composer packages and generate a key

```bash
cd laravel && composer install && php artisan key:generate && cd ..
```

6. Create an symbolic link to for the storage folder
```bash
cd laracel && php artisan storage:link && cd ..
```

## Run

When you have done the getting started part, it's time to start the docker containers.

```bash
docker compose up -d --build
```

After this only do a Laravel migration to the database and you are ready!

```bash
cd laravel && php artisan migrate
```
</details>

## Tools

### Create storage symlink

When you create a symlink according to the laravel command (`php artisan storage:link`) it will create a static link and
cause problems in the docker container. It's best to run the following command to get the same result:

```bash
cd public && ln -s ../storage/app/public storage
```

### Create a backup

To make a backup of the application, run the command below.

```bash
php artisan backup:run
```

## Contributing

Would you like to contribute to the development of this project? Then read the prepared [contribution guidelines](CONTRIBUTING.md) and go ahead!

Thank you for being involved! :heart_eyes:

## License

MIT License

Copyright (c) 2021-2022 Klaas Schoute

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

<!-- MARKDOWN LINKS & IMAGES -->
[maintenance-shield]: https://img.shields.io/maintenance/yes/2022.svg?style=for-the-badge
[contributors-shield]: https://img.shields.io/github/contributors/platformdroneracingnl/racing-events.svg?style=for-the-badge
[contributors-url]: https://github.com/platformdroneracingnl/racing-events/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/platformdroneracingnl/racing-events.svg?style=for-the-badge
[forks-url]: https://github.com/platformdroneracingnl/racing-events/network/members
[stars-shield]: https://img.shields.io/github/stars/platformdroneracingnl/racing-events.svg?style=for-the-badge
[stars-url]: https://github.com/platformdroneracingnl/racing-events/stargazers
[issues-shield]: https://img.shields.io/github/issues/platformdroneracingnl/racing-events.svg?style=for-the-badge
[issues-url]: https://github.com/platformdroneracingnl/racing-events/issues
[license-shield]: https://img.shields.io/github/license/platformdroneracingnl/racing-events.svg?style=for-the-badge
[commits-shield]: https://img.shields.io/github/commit-activity/y/platformdroneracingnl/racing-events.svg?style=for-the-badge
[commits]: https://github.com/platformdroneracingnl/racing-events/commits/master
[last-commit-shield]: https://img.shields.io/github/last-commit/platformdroneracingnl/racing-events.svg?style=for-the-badge