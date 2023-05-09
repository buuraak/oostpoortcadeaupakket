# oostpoortcadeaupakket

Simple Laravel project where users can win a goodie bag worth €100 by participating and inviting their friends. A user can participate once every month.

Technologies this project includes:
1. PHP Laravel
2. Vue.js
3. Axios
4. SCSS
5. Toastr
6. Laravel Mailer
7. Laravel Scheduler (To send reminders to participants who haven't verified 3 days after receiving email)
8. Form validation
9. Google Sheets API
10. <a target="_blank" href="https://github.com/Propaganistas/Laravel-Disposable-Email">Laravel Disposable Email API</a>

Todo's:
1. E2e testing to check whether form submission works properly.
2. Prevent standard php errors to show in toastr notification.
3. Organize HomeController.php file for better readability.
4. Implement type declaration to functions.

## Set up
To set up projects run the following commands in the root of the project:<br><br>
composer:
<pre><code>composer install</code></pre>
npm:
<pre><code>npm install</code></pre>
database:
<pre><code>php artisan migrate</code></pre>

To build the CSS and JS files and to watch for any changes we can run:
<pre><code>npm run dev && npm run watch</code></pre>

I used <a target="_blank" href="https://laravel.com/docs/10.x/valet">Laravel valet</a> to set up my development environment.
<pre><code>valet link && valet secure</code></pre>


