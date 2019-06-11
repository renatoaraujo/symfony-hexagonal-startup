Symfony startup
===============

This is just a simple startup for a Symfony project ready for web rest application using Hexagonal Architecture structure.

This is a docker based application, so you **MUST** have the Docker running in your local machine or you will need to setup the environment by hand using PHP 7.3 and MySQL 8.

### Requirements

- Docker
- Docker Composer

### Setup the application and installation

Just run on your machine (Unix/OSX) the command on you project path:
```bash
$ make setup
```
- This command will build the image, run and install all application dependencies including database tables. 

#### Database

To setup the database from scratch (Added sleep time of 25s just for the first installation):
```bash
$ make database
```

To run the migrations only without load any fixtures:
```bash
$ make migrate
```

To create migrations you can just use:
```bash
$ make diff
```

To load the fixtures:
```bash
$ make fixtures
```

#### Run

If you already have the containers running just use the `up` command as following:
```bash
$ make up
```

#### Test

To run the unit/functional tests just use the following:
```bash
$ make test
```
