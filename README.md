

  This is a practice project using the Laravel web application framework and written in JavaScript, PhP and Blade programming languages.  The project application contains an admin panel and complete CRUD for users, posts, replies, roles and permissions. Other implementations: authentication security, permissions based on roles, policies, symbolic link, pagination, image upload and search.
 The inspiration of this project comes from the Udemy Web Development course "PHP with Laravel for beginners - Become a Master in Laravel" by Edwin Diaz.
 
## How to make the project work

 In order to make the project work you need to create a mysql database named laravel_project_7x (or you can rename it to your new database name in the ENV file, if there is no ENV file, create one) then inside the project open a CMD terminal and enter the following command: 
 
 php artisan migrate
 
 After the migrations succeded you are able to register, login and use the web application. In order to make it 'prettier', as intended, also run: 
 
 npm install && npm run dev
 
## About Laravel

 <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.
