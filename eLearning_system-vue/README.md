<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.


Technologies used for this project: PHP, Laravel, HTML5, CCS3, JavaScript, Vue.js, Mysql, Bootstrap(-Vue).

Step 1: Go to https://www.apachefriends.org/index.html and install 'XAMPP'

Step 2: Unpack the package into a directory of your choice. Please start the "setup_xampp.bat" and beginning the installation.

Step 3: upon successful installation, open XAMPP and  navigate to the 'Actions' part in the middle and click on 'Start'for 'Apache' and 'MySQL' or run the command 'sudo /opt/lampp/lampp start' in terminal.

Step 4: Place my folder (am1099 (clone this repository)) in 'C:\xampp\htdocs' (Unzip the file first)

Step 5: Open Xampp window and click on 'admin' where it refrences 'MySQL' (should be the second line, next to 'Start/Stop' button), which should take to a web page called phpmyadmin or you should be able to by typing in 'http://127.0.0.1/phpmyadmin/' in your browser (if this does not work try installing phpmyadmin (if you are using linux by running the command ' sudo apt-get install phpmyadmin') phpmyadmin (if you are using linux by running the command ' sudo apt-get install phpmyadmin')

Step 6:Please follow the steps in this link to install composer and laravel in order to run my project https://linuxhint.com/install-laravel-on-ubuntu/
If you come to errors this link should help, https://blog.chapagain.com.np/solved-laravel-error-failed-to-open-stream-no-such-file-or-directory-bootstrapautoload-php/#:~:text=This%20error%20generally%20occurs%20when,Cause%3A&text=The%20missing%20dependencies%20should%20be,to%20make%20Laravel%20run%20properly.

Step 7: Once you are in phpmyadmin, Click on the 'New' button to create a database,

Step 8: Call the database eLearningSystem then click on 'create'

Step 9: cd onto my project folder and run this command in terminal 'php artisan migrate' (to create the migration and create all the tables), then run 'php artisan serve' to run the website. (link should come up, just add '/login' in front of it). Then run 'npm run watch'.

DATABASE DETAILS:
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eLearningSystem
DB_USERNAME=root
DB_PASSWORD=

Step 9: Insert the following sql queries into the database to be able to see the programs created and to be able to play the two activities that were created.
Create student user by intering this query into phpmyadmin:
INSERT INTO student_users (stu_id, fullname, email, date_of_birth, password, remember_token, created_at, updated_at) VALUES ('1', 'student test', 'student@student', '2018-07-11', '123123123123', NULL, NULL, NULL);
enter the following in order:

1: INSERT INTO programs (prog_id, prog_name, prog_desc, prog_type, prog_difficulty, validated, created_by_id) VALUES
(1, 'Down Syndrome', 'This program is for kindergarten children with Down Syndrome and significant learning difficulties. This is based on visual concept matching and identification in Literacy, numeracy and reasoning.', 'Downsyndrome', 'Kindergarten', 1, 1),
(2, 'Dyslexia', 'This program is for kindergarten children with Dyslexia with reading learning difficulties. This is based on visual concept matching and identification in Literacy, numeracy and reasoning.', 'Dyslexia', 'Kindergarten', 1, 1);

2: INSERT INTO modules (mod_id, mod_name, mod_desc, mod_difficulty, validated, created_by_id, program_id) VALUES
(1, 'Literacy', 'This module covers learning letters and basic domestic words.', 'Easy', 0, 1, 1),
(2, 'Numeracy', 'This module covers learning concepts of numbers and digits from 1- 10', 'Easy', 0, 1, 1),
(3, 'Reasoning', 'This module covers, basic logic and reasoning, of colors, shapes ...etc', 'Easy', 0, 1, 1),
(4, 'Literacy', 'This module covers learning letters and basic domestic words.', 'Easy', 0, 1, 2),
(5, 'Numeracy', 'This module covers learning concepts of numbers and digits from 1- 10', 'Easy', 0, 1, 2),
(6, 'Reasoning', 'This module covers, basic logic and reasoning, of colors, shapes ...etc', 'Easy', 0, 1, 2);

3: INSERT INTO units (unit_id, unit_name, unit_desc, unit_difficulty, validated, created_by_id, module_id, program_id) VALUES
(1, 'Digits 1 to 5', 'This unit covers digits 1 to 5', 'Easy', 0, 1, 2, 1),
(2, 'Digits 5 to 10', 'This unit covers digits 5 to 10', 'Easy', 0, 1, 2, 1),
(3, 'Digits 1 to 10', 'This unit covers digits 1 to 10', 'Easy', 0, 1, 2, 1),
(4, 'Letters A to E', 'This unit will test the user on letters A to E', 'Easy', 0, 1, 4, 2),
(5, 'Letters E to J', 'This unit will test the user on letters E to J', 'Easy', 0, 1, 4, 2),
(6, 'Letters J to O', 'This unit will test the user on letters J to O', 'Intermediet', 0, 1, 4, 2),
(7, 'Letters A to Z', 'This unit will test the user on letters A to Z', 'Intermediet', 0, 1, 4, 2);

4: INSERT INTO lessons (les_id, les_name, les_desc, les_difficulty, validated, created_by_id, unit_id, program_id) VALUES
(1, 'Digits 1 to 3', 'This lesson covers digits 1 to 3', 'Easy', NULL, 1, 1, 1),
(2, 'Digits 3 to 5', 'This lesson covers digits 3 to 5', 'Easy', NULL, 1, 1, 1),
(3, 'Digits 1 to 5', 'This lesson covers digits 1 to 5', 'Easy', NULL, 1, 1, 1);

5: INSERT INTO activities (act_id, act_name, act_desc, act_difficulty, correct_answer, act_question, act_script, act_images, act_min_keystrokes, validated, created_by_id, lesson_id, program_id) VALUES
(1, 'Concept Matching images with text number', 'Matching chosen image with the corresponding digit number written in text.', 'Easy', '2 apples  = TWO', 'How many apples are there?', NULL, NULL, 5, 0, 1, 1, 1),
(2, 'Concept Matching images with digit number', 'Matching chosen image with the corresponding digit number', 'Easy', '2 apples = 2', 'How many apples are there?', NULL, NULL, 3, 0, 1, 1, 1);
