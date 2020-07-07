# How to
1. Install [docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04) & [docker-compose](https://www.digitalocean.com/community/tutorials/how-to-install-docker-compose-on-ubuntu-16-04#);
2. Clone or download Pion-example project;
3. Run `docker-compose up --build` in project directory (this may take some time);
4. Add `127.0.1.1	pion-example.loc` to your hosts file;
5. Go to http://pion-example.loc:8020/
6. Explore :)


---

# Starting Point
Start exploring this example from the [web-app/web/index.php](https://github.com/ChrisGalliano/PionExample/blob/master/web-app/web/index.php)

---


# Gulp
## Watching changes
By default, gulp is running in production mode. The "watching changes" feature is available in developer mode.
If you want to run gulp in developer mode please add the following environment variable: `PION_EXMPL_DEBUG=1`.


# Docker
### most used commands
`docker-compose up --build` - build images & start containers.

`docker container ls` - show all containers (default shows just running).

`docker stop $(docker ps -q)` - stop all running containers.

`docker-compose stop` - stop all containers is current directory.

`docker rm $(docker ps -a -q -f status=exited)` - remove stopped containers.

`docker exec -it <container_id> bash` - get a bash shell in the container.


# Doctrine
# Command line tools
https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/tools.html#command-overview

### most used commands (should be executed inside php container)
`vendor/bin/doctrine orm:schema-tool:update --force` - processes the schema and update the database schema of EntityManager Storage Connection

### helpful guides
https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html