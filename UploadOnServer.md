# Upload Laravel Project On Live Server 
# -----------------------------------------

- Clearing view, config, cache with command 

     - php artisan view:clear
     - php artisan config:clear
     - php artisan cache:clear
     - php artisan route:clear

- Project zipping
- Database exporting from xampp 'localhost/phpmyadmin'
- Go to host seller website login and go to cpanel
- On cpanel "Select PHP Version" (Respect of Framework support)
- Database creating on cpanel 'mysql database'
     - Database name creation
     - Database user creation
     - Database user selecting and giving power in 'managing user privileges' on cpanel
- Go to domain(public_html) / created subdomain(inside subdomain) in cpanel  
- Upload created zip file(project) on domain/subdomain 
- If unable to see .env file: setting(right corner) -> click on 'Show Hidden Files (dotfiles)' -> Save 
- Edit .env file with db name, user name, password (perfectly)
- Took 'index.php' from Project 'public' folder's to root 
- Edit 'index.php' :
     - require __DIR__.'/vendor/autoload.php';
     - $app = require_once __DIR__.'/bootstrap/app.php';
- Config-> app.php ->  'asset_url' =>"https://course.answeringlibrary.com/", (put your own site url) 