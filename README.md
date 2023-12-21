# cinema_website
Simple cinema website with admininstration panel and database.

## 
![Webpage screenshot](screenshots/index.jpg?raw=true "Preview")

## Description

News section is not created. Under this section is a place where films played today, or up to six day ahead (based on dropdown value) will be displayed. After clicking row with any film title, we will be redirected to film description with poster and button which lead to show film screening dates, where we can chose date and language, and provide our personal data to buy a ticket.  
Film description:
![Webpage screenshot](screenshots/film_description.jpg?raw=true "Preview")  
Buying tickets:
![Webpage screenshot](screenshots/buy_ticket.jpg?raw=true "Preview")

After clicking 'Submit' to buy tickets you  will see the information that you need to pay in the cinema, and just need to confirm reservation with providen button (That is the place where online paying should be). After clicking it, you can download your ticket information and you order is confirmed. You can also check your order status by clicking ORDER STATUS on the navigation panel and provide your order id that you have in the downloaded file.

### Admin panel
> [!IMPORTANT]
> To open admin panel, you need to change index.php in you url to admin.php.
You need to login with login and password provided in the database table: login.
There is some forms to add shows, rooms, films, delete them, some stats tables etc.
![Webpage screenshot](screenshots/admin.jpg?raw=true "Preview")

## Instaling

Download repository. Unpack fpdf. Create database named cinema_db and import cinema_db.sql into it. 
> [!NOTE]
> In the nav section, to corect redirect user by clicking on the HOME, ORDER STATUS etc. you need to change absolute path to these files in the: templates/nav.php

### Created with

Visual Studio Code - html, css, js
