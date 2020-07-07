# About
This repository is the basis on which I start to build all my projects. An example is based on the Pion and my favorite components needed to run any modern application:
- [Peony](https://github.com/ChrisGalliano/PeonyTemplating) - a lightweight templating engine designed for the Pion Framework
- [Muon](https://github.com/ChrisGalliano/MuonForms) - a forms engine designed for the [Peony Templating]() & [Pion Framework]()
- [Docker](https://www.docker.com/) - a set of platform as a service (PaaS) products that uses OS-level virtualization to deliver software in packages called containers
- [Docker Compose](https://docs.docker.com/compose/) - a tool for defining and running multi-container Docker applications
- [MariaDB](https://mariadb.org/) - one of the most popular open source relational databases
- [PhpMyAdmin](https://www.phpmyadmin.net/) - a free software tool, intended to handle the administration of MySQL over the Web
- [Nginx](https://nginx.org/en/) - the most popular web-server
- [Ofelia](https://github.com/mcuadros/ofelia) - an awesome job scheduler for docker environments (in short - crontab for docker)
- [Doctrine](https://www.doctrine-project.org/) - one of the best ORM for PHP
- [Symfony Console](https://symfony.com/doc/current/components/console.html) - a component allows you to create command-line commands
- [Symfony EventDispatcher](https://symfony.com/doc/current/components/event_dispatcher.html) - provides tools that allow your application components to communicate with each other by dispatching events and listening to them
- [Gulp](https://gulpjs.com/) - a task manager for automatically performing frequently used tasks
- [JQuery](https://jquery.com/) - a JavaScript framework focusing on the interaction of JavaScript and HTML
- [Babel](https://babeljs.io/) - a JavaScript compiler that allows you to use modern ES5, ES6 tools in old browsers
- [Typescript](https://www.typescriptlang.org/) - a typed superset of JavaScript that compiles to plain JavaScript
- [PostCss](https://postcss.org/) & [Sass](https://sass-scss.ru/)
- [Underscore](https://underscorejs.org/) - a JavaScript library that provides a whole mess of useful functional programming helpers without extending any built-in objects
- and a bunch of js packages for all kinds of optimizations, auto-prefixing, etc.


## How to use
1. Install [docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04) & [docker-compose](https://www.digitalocean.com/community/tutorials/how-to-install-docker-compose-on-ubuntu-16-04#);
2. Clone or download Pion-example project;
3. Run `docker-compose up --build` in project directory (this may take some time);
4. Add `127.0.1.1	pion-example.loc` to your hosts file;
5. Go to http://pion-example.loc:8020/
6. Explore :)


---

## Starting Point
Start exploring this example from the [web-app/web/index.php](https://github.com/ChrisGalliano/PionExample/blob/master/web-app/web/index.php)

---


## Gulp
### Watching changes
By default, gulp is running in production mode. The "watching changes" feature is available in developer mode.
If you want to run gulp in developer mode please add the following environment variable: `PION_EXMPL_DEBUG=1`.


## Docker
### most used commands
`docker-compose up --build` - build images & start containers.

`docker container ls` - show all containers (default shows just running).

`docker stop $(docker ps -q)` - stop all running containers.

`docker-compose stop` - stop all containers is current directory.

`docker rm $(docker ps -a -q -f status=exited)` - remove stopped containers.

`docker exec -it <container_id> bash` - get a bash shell in the container.


## Doctrine
### Command line tools
https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/tools.html#command-overview

### most used commands (should be executed inside php container)
`vendor/bin/doctrine orm:schema-tool:update --force` - processes the schema and update the database schema of EntityManager Storage Connection

### helpful guides
https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html