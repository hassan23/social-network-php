# social_books
ABOUT
it is a simple subset of any social networing website about how the basic social site works.
i build this in PHP.

 SIMPLE STEPS TO GET THIS PROJECT RUNNING
#### STEP-1: make sure you have XAMP or WAMP preinstalled on your system, if not you can always download it from XAMP website it is always free.
(AFTER INSTALLING XAMP)
#### STEP-2:copy this social_book folder into 'htdocs'(for wampp it will be 'www') inside the installed 'C://xampp/' directory.
#### STEP-3:after copying the folder, go to your browser and type 'localhost' in the url field , this will open the home page of xampp.
#### STEP-4:down in the lefthand side in the home page you will see a section name 'tools' in which you have to click on phpmyadmin this will open the mysql database.
#### STEP-5:click on new in the left hand side and make a new database name social_book and hit create, this will make a new database name social_book for you.
(before moving further make few changes: 
 - STEP-1: if your mysql database have a password then goto social_book/root/php_includes/db_conx.php 
 - STEP-2: replace the 2nd and 3rd parameter in 'mysqli_connect' function with your user name and password respectively.
 - STEP-3: if your mysql database does not have any password then leave those places blank.)
#### STEP-6:type in 'localhost/social_book/root/table_creation.php' in your browser, this will create all the required table in the database(social_book).
#### STEP-7:type in 'localhost/social_book/root/login.php'. from here you can enjoy this simple social network.
HINT TO UTILIZE THIS PROJECT
#### HINT-1:start by registering two user and sending friend request from one user to another.
#### HINT-2: you can search any user ever register by the search bar provided above(hitting enter doesn't work on this, you have to click on search button.)
 
