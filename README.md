# howsy-rest
**How to install**

After cloning, run the following commands :

1 - ```composer update```\
2 - ```npm install```

3 - To execute it on docker containers, the docker-compose which is included runs a Nginx and a MySQL 5.7 containers. 
The name of database created, user and password are all "howsy".\
```docker-compose -f docker-compose-api.yml up -d```

4 - ```php artisan migrate```\
5 - ```php artisan db:seed --class=PropertiesTableSeeder```


Endpoints :\
GET (index) : ```/addresses```\
GET (show) : ```/address/ID```\
POST (create) : ```/address```\
PUT (update) : ```/address```\
DELETE : ```/address/ID```

If you run ```npm run dev```, there's a small VueJs CRUD app available showing the records.
