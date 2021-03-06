Street Art
================

Development
---
Start the server

```shell
docker-compose up
```

Add `-d` options to demonize command

Now you can go to `http://localhost/api`


Create .env file
```shell
cp .env.dist .env
```

Install node dependencies

```shell
npm install
```

Install run dev server 

```shell
npm run dev-server
```

Utils
--- 

Load fixtures 
```
docker-compose exec -T php bin/console hautelook:fixtures:load
```

Extract translation messages
``` bash
docker-compose exec -T php bin/console translation:extract
```

Delete obsolete translation messages
``` bash
translation:delete-obsolete
```

Fix PHP CS
``` bash
vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix --config=.php_cs.dist
```


Usefull routes
---

Show emails

Go to `http://localhost:1080`

Show API documentation

Go to `http://localhost/api`


Before merging 
---

``` bash
./vendor/bin/phpstan analyse --level 2 -c .circleci/tools/phpstan.neon src
```

``` bash
.circleci/tools/php-cs-fixer.sh
```

