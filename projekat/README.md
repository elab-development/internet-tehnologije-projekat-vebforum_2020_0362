# PROJEKAT IZ ITEHA 📝WEBFORUM📝 APLIKACIJA!

Projekat se bazira na implementaciji full stack aplikacije koja služi korisnicima kao svestrani web forum. Zamisao jeste da se na vizuelno lep i pregledan način prikažu sve dostupne kategorije foruma, nakon čega korisnici mogu postavljati svoje objave, pregledati ostale, ostavljati pozitivnu i negativnu reakciju i čak komentarisati. Pored svega implementiranog u okviru projektnog zadatka, aplikacija ima mesta za dalje širenje i usavršavanje u pravcu multifunkcionalnog foruma koji može imati veliki značaj za razmenu znanja korisnika.

# Instalacija i pokretanje aplikacije

## 1. Pokretanje Laravel servera
```
cd projekat
cd webforum-backend
composer install
php artisan serve
```
## 2. Pokretanje Vue.js frontend strane
```
cd projekat
cd webforum-backend
cd front-vue
npm install
npm run dev
```

## Frontend (Vue.js):

Frontend je implementiran pomoću Vue.js, koji je popularan JavaScript framework za izgradnju korisničkih interfejsa. Vue.js se koristi za kreiranje korisničkog interfejsa (UI) i interakciju sa korisnicima putem pregledača.

U main.js datoteci, koristi se Vue funkcija createApp za kreiranje instance Vue aplikacije. Konfigurisanje rutiranja koristeći router koji je učitan iz ./router datoteke, što omogućava navigaciju između različitih delova aplikacije. Takođe je ucitan i Vuex store iz ./store datoteke, što je centralizovano mesto za skladištenje podataka u aplikaciji.

Import App.vue datoteke predstavlja glavnu komponentu aplikacije. Biblioteke za ikone, poput Font Awesome, takođe su učitane i konfigurisane. Nakon podešavanja svih neophodnih modula, Vue aplikacija se montira u elementu sa ID-jem app u HTML dokumentu.

## Axios za HTTP zahteve:

U projektu, koristi se Axios za obavljanje HTTP zahteva ka serverskoj strani. Konfigurisana je Axios instanca u axios.js datoteci, gde se postavlja osnovna URL adresu API-ja. Takođe implementiran je interceptor zahteva koji automatski dodaje JWT token u zaglavlje zahteva iz Vuex store-a.

## Backend (Server):

Backend aplikacija izgrađena je uz pomoc Laravel frameworka. Backend služi kao posrednik između funkcionalnosti nad modelima i baze podataka. Prima zahteve od korisnika putem HTTP protokola, obrađuje ih i vraća odgovor. 

Ovo su sve dostupne rute u vašem Laravel backendu, koje su organizovane u dve grupe - javne rute i zaštićene rute:

1. **Javne rute:**
   - `GET /comment/{id}`: Prikazuje komentar sa određenim ID-jem.
   - `GET /getAllComments`: Prikazuje sve komentare.
   - `PUT /user/{id}`: Ažurira korisnika sa određenim ID-jem.
   - `GET /user/{id}`: Prikazuje informacije o korisniku sa određenim ID-jem.
   - `POST /testPass/{id}`: Testira i ažurira lozinku korisnika.
   - `POST /register`: Registruje novog korisnika.
   - `GET /post`: Prikazuje sve objave na forumu.
   - `GET /post/user/{id}`: Prikazuje objave kreirane od strane određenog korisnika.
   - `GET /categorie`: Prikazuje sve kategorije objava.
   - `GET /post/{id}`: Prikazuje određenu objavu na forumu.
   - `GET /post/categorie/{id}`: Prikazuje objave u određenoj kategoriji.
   - `POST /login`: Autentifikacija korisnika.
   - `GET /users`: Prikazuje sve korisnike.
   - `DELETE /user/{id}`: Briše korisnika sa određenim ID-jem.
   - `POST /loginAdmin`: Autentifikacija administratora.
   - `POST /registerAdmin`: Registracija administratora.
   - `POST /post/like`: Dodavanje lajka na objavu.
   - `POST /post/dislike`: Dodavanje dislajka na objavu.
   - `DELETE /post/like/{id}`: Uklanja lajk sa objave.
   - `DELETE /post/dislike/{id}`: Uklanja dislajk sa objave.
   - `DELETE /post/{id}`: Briše objavu sa određenim ID-jem.
   - `GET /token`: Prikazuje CSRF token.

2. **Zaštićene rute:**
   - Rute unutar ove grupe zahtevaju autentifikaciju putem Sanctum middleware-a.
   - `POST /post`: Kreira novu objavu na forumu.
   - `POST /comment`: Komentariše određenu objavu.
   - `PUT /post/{id}`: Ažurira određenu objavu na forumu.
   - `POST /logout`: Odjavljuje korisnika.

## Baza podataka:

Aplikacija koristi bazu podataka za trajno skladištenje podataka, kao što su korisnički podaci, objave na forumu, komentari, itd.
U pitanju je relaciona baza podataka MySQL. Backend server komunicira sa bazom podataka za čitanje, upisivanje, ažuriranje i brisanje podataka.

## PMOV

![PMOV drawio](https://github.com/elab-development/internet-tehnologije-projekat-vebforum_2020_0362/assets/154702539/788c506f-5c17-4da8-8340-2d6db2a49ca9)


