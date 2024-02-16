<h3>Setup Guide : </h3>
<p>- Clone the project from the repository. </p>
<p>- Install the composer in the project directory. (composer install) </p>
<p>- Make the .env file by copying the .env.example file. </p>
<p>- Generate the unique application key in .env. (php artisan key:generate) </p>
<p>- Migrate the tables. (php artisan migrate) </p>
<p>- Seed the tables. (php artisan db:seed) </p>
<p>- Install npm or yarn dependency manager. (npm install OR yarn install) note: yarn prefered </p>
<p>- To compile all the CSS and JS file execute the command. (npm run dev OR yarn run dev) </p>
    ```
<p>Place the hooks folder content inside folder .git/hooks (unix platform commands is given below)</p>
 ```
        cp ./hooks/* ./.git/hooks 
        // Making sure the file is executable
        sudo chmod +x ./.git/hooks/pre-commit
 ```
 <p>Use bellow command to check if any minor fixes need to be done </p>
  ```
       composer sniff
 ```
 <p>Use bellow command to fix the problems </p>
  ```
       composer lint
 ```
