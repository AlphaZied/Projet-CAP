#Projet Jeu Capitales

###Standardisation
####Head
```html
<title>PlayCapital - Découvre le monde en t'amusant ! </title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="PlayCapital est un jeu multijoueur gratuit. Défiez vos amis, découvrez de nouvelles capitales et amusez-vous !" />
<link rel="shortcut icon" href="/favicons.ico" />
<link rel="stylesheet" href="/style.css" type="text/css">
```

###Technologies :
- Design (CSS3) : Minimalisme, Inspiration de l'aspect de sites web 2.0
- Communication client/serveur : Websockets (NodeJS) et éventuellement dans certains cas et pages Ajax
- Communication serveur/DB : PDO --> MySQL (prénommer les tables et colonnes)
- Dynamisme client du site : Javascript (& Jquery)

###Fonctionnalités :
+ Pour chaque pays concerné par une question (capitale, drapeau ou autres...) on diffuse une série d'infos anecdotiques sympa sur le pays en question (lieu du quizz) + mise en place des niveaux de difficultés et des gains d'XP en conséquence.
+ Espace membre (Home) : 
- Système d'amis
- Statistiques (parties jouées, perdues, gagnées, xp gagné)
- Afficher niveau
- Classement chaque semaine
- Paramètres (modifier mot de passe + image profil)
+ Un panel de connexion et d'inscription (+ récupération mot de passe ?)

###Codes couleurs :
- Bleu, vert, blanc (nuages + atmosphère)
- Bleu : celui de Paypal ou Skype...
- Vert : celui de w3schools, whatsapp...
- Jouer sur des dégradés (vert-bleu), par exemple :
```css
background-image: linear-gradient(120deg, #155799, #159957);
```