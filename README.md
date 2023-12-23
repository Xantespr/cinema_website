# cinema_website
Simple cinema website with admininstration panel and database.

## 
![Webpage screenshot](screenshots/index.jpg?raw=true "Preview")

## Description

- The news section hasn't been updated. 
* Under the news section, there's one where you can view the movies that are currently playing or will be playing up to six days in advance (depending on the dropdown selection). 
+ If you click on any movie title, you will be taken to a page with the movie description, poster, and a button. Clicking on the button will show you the movie screening dates, where you can choose the date and language, and then provide your personal information to purchase tickets.

Film description:
![Webpage screenshot](screenshots/film_description.jpg?raw=true "Preview")  
Buying tickets:
![Webpage screenshot](screenshots/buy_ticket.jpg?raw=true "Preview")

- After clicking 'Submit' to buy tickets you will see the instruction: You need to pay in the cinema, and only confirm your reservation with the provided button (That's a section where online paying should be).
- After clicking it, you can download your ticket information. Then your order is confirmed. 
- You can also check your order status by clicking ''ORDER STATUS'' on the navigation panel and providing the order ID that you have in the downloaded file.


### Admin panel
> [!IMPORTANT]
> You must use the login and password provided in the database table to log in. 
- There are some forms. By using them, you can add: shows, rooms, films, some sats tables, etc. but also, you could delete them.

![Webpage screenshot](screenshots/admin.jpg?raw=true "Preview")

## Instaling

- download the repository
- unpack fpdf
- create the database named "cinema_db" 
- then, import "cinema_db.sql" into it.

> [!NOTE]
> In the nav section, to corect redirect user by clicking on the HOME, ORDER STATUS etc. you need to change absolute path to these files in the: templates/nav.php

### Created with

Visual Studio Code - html, css, js
