# EJChecker

Laravel and VueJS 2 application for checking EuroJackpot statistics

## Development

Before you can build this project, you must install and configure the following dependencies on your machine:

1. [npm][]: We use npm to manage dependencies.
   Depending on your system, you can install npm either from source or as a pre-packaged bundle.
2. [Node.js][]: We use Node to run a development web server and build the project.
   Depending on your system, you can install Node either from source or as a pre-packaged bundle.
3. [Composer][]: We use composer to manage PHP dependencies.
4. [NGINX][]: We use NGINX for his reverse proxy.

After installing, you should be able to run the following command to install development tools.
You will only need to run this command when dependencies change in [package.json](package.json).
Change directory to src/admin-vue/ and run:

    npm install 

After installing npm you have to install [Quasar][]:

    npm install -g quasar-cli

You will only need to run this command when dependencies change in [composer.json](composer.json).
Change directory to src/admin-api/ and run:

    composer install
 
After composer install run:

    php artisan migrate:refresh --seed
    
### Runing development server

Change directory to src/admin-api/ and run:
    
    php artisan serve
    
Change directory to src/admin-vue/ and run:
    
    quasar dev
    
Access development on:

      localhost:1234

## Using Docker to simplify development (optional)

You can use Docker to improve your development experience. 
A number of docker-compose configuration are available in the Dockerfile to launch required third party services. 
For example, to start application in a docker container, run:
  sudo docker-compose up -d
  
  
[npm]: https://www.npmjs.com/
[Node.js]: https://nodejs.org/en/
[Composer]: https://getcomposer.org/
[NGINX]: https://nginx.org/en/
[Quasar]: http://quasar-framework.org/
  
