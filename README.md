# How to
1. Install [docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04) & [docker-compose](https://www.digitalocean.com/community/tutorials/how-to-install-docker-compose-on-ubuntu-16-04#);
2. Clone or download Pion-example project;
3. Run `docker-compose up --build` in project directory (this may take some time);
4. Add `127.0.1.1	pion-example.loc` to your hosts file;
5. Go to http://pion-example.loc:8020/
6. Explore :)


# Gulp
## Watching changes
By default, gulp is running in production mode. The "watching changes" feature is available in developer mode.
If you want to run gulp in developer mode please add the following environment variable: `PION_EXMPL_DEBUG=1`.