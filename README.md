# Objectif #


# Liste des containers Docker #


# Installation #
### Prérequis ###
```angular2html
$ Port 80 should be open ( apache2, nginx etc could use it )
$ mkdir -p ~/projects_6tm && cd ~/projects_6tm
$ git clone git@github.com:EpitechPromo2027/B-EPI-310-REN-3-1-hackathonweek-malo.souki-leon.git
```

### Step 1 - Env Vars ###
```angular2html
$ cp .env.dist ./.env
```
- modify all '/PATH/TO/DIR' by absolute or relative path

### Step 2 - Create Docker Network and Run ###
```angular2html
$ docker compose up --build -d
```

### Step final - Delete all Docker Network ###
```angular2html
$ docker rm -f $(docker ps -a -q)
```

### Access migration ###
```angular2html
$ docker exec -ti php bash
$ php bin/console doctrine:migrations:diff
$ php bin/console doctrine:migrations:migrate

$ php bin/console doctrine:migrations:migrate --force
```