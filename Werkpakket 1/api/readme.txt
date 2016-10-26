Installatie stappenplan api localhost:

1. zet de map API in de root van je htdocs/
2. zorg dat in de file API/index.php deze regel staat:
        header('Location: http://localhost/api/public/home.html');
3. zorg dat in de file API/app/views/HomeView de link ook via localhost gaat
