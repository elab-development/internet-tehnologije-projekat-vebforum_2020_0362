# REST API ZA 📝WEBFORUM📝 APLIKACIJU

Dati API ima 4 modela: User, Thread, Post, Comment. Kardinalnosti između ovih modela su sledeće:
1. **User** može da kreira (*veza Creates*) više **Thread**-ova, dok jedan **Thread** može biti kreiran od jednog i samo jednog **User**-a.
2. Jedan **Thread** može imati (*veza Has*) više **Post**-ova, dok jedan **Post** može imati jedan **Thread**.
3. Jedan **User** može kreirati (*veza Creates*) više **Post**-ova, dok jedan **Post** može biti kreiran od jednog i samo jednog **User**-a.
4. Jedan **Post** može imati (*veza Has*) više **Comment**-ara, dok jedan **Comment** može biti vezan za jedan i samo jedan **Post**.
5. **Jedan User** može kreirati (*veza Creates*) više **Comment**-ara, dok jedan **Comment** može biti kreiran od samo jednog **User**-a.

PMOV(Prosireni Model Objekti-Veze) datog Rest API-ja na kome se vide modeli i Eloquent veze između njih prikazan je na slici ispod:
![Opis slike](https://i.postimg.cc/NjszdTHw/VEBFORUM.png)
