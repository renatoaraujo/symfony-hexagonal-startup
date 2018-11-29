Symfony startup
===============

This is just a simple startup for a Symfony project ready for web rest application using Hexagonal Architecture structure.

### Requirements

- Docker (optional but nice to have)
- Docker Composer (optional but nice to have)
- PHP >= 7.2
- MySQL >= 8

### Install (using Docker)

Just run on your machine (Unix/OSX) the command on you project path:
```bash
$ make setup
```

#### Database

To setup your db after setup the environment:
```bash
$ make db
```

To run the migrations only without load any fixtures:
```bash
$ make migrate
```

To create migrations you can just use:
```bash
$ make migrations
```

#### Run

If you already have the containers running just use the `up` command as following:
```bash
$ make up
```

#### Test

To run the unit/functional tests just use the following:
```bash
$ make up
```
