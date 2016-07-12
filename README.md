#ExtraGeo GAME

###Standardisation
####Head
```html
<title>ExtraGeo - La géographie amusante</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="ExtraGeo est un jeu multijoueur en ligne et gratuit. Défiez vos amis dans des duels dont seul vos connaissances du terrain vous aideront à vous surpasser !" />
<link rel="shortcut icon" href="/favicons.ico" />
<link rel="stylesheet" href="/style.css" type="text/css">
```

###Technologies :
- Design (CSS3) : Inspiration de l'aspect de sites web 2.0 & Concept de l'Extra-Terrestre
- Communication client/serveur : Websockets (NodeJS) et éventuellement dans certains cas et pages Ajax
- Communication serveur/DB : PDO --> MySQL (prénommer les tables et colonnes)
- Dynamisme client du site : Javascript (& Jquery)

###Fonctionnalités :
1. Champs de bataille : Pour chaque pays concerné par une question (capitale, drapeaux, présidents, monuments, langues parlées...) on diffuse une série d'infos anecdotiques sympa sur le pays en question + mise en place des niveaux de difficultés et des gains d'XP.
2. Espace membre (Home) : 
 * Système d'amis
 * Statistiques (parties jouées, perdues, gagnées, xp gagné)
 * Afficher niveau
 * Classement chaque semaine
 * Paramètres (modifier mot de passe + image profil)
3. Un panel de connexion et d'inscription (avec récupération mot de passe et mail de bienvenue)

###Codes couleurs :
- Bleu, vert, blanc (nuages + atmosphère)
- Bleu : celui de Paypal ou Skype...
- Vert : celui de w3schools, whatsapp...
- Jouer sur des dégradés (vert-bleu), par exemple :
```css
background-image: linear-gradient(120deg, #155799, #159957);
```
###Tables :
####Infos sur l'utilisateur = users
- Clé primaire = id
- Nom du joueur = pseudo
- Niveau du joueur = lvl (valeur par défault = 1)
- Adresse mail du joueur = email
- Mot de passe du joueur = mdp
- Champs d'expérience (la barre d'xp qui permet le changement de niveau lorsqu'elle est pleine) = exp (valeur par défault = 0)
- Image de profil du joueur = pdp
- Score pour chaque continent (Afrique;AmériqueDuNord;AmériqueDuSud;Europe;Asie;Océanie;Monde) = score (valeur par défault = 0;0;0;0;0;0;0)
- Amis du joueur (id de l'ami 1; id de l'ami2; id de l'ami3...) = amis
- IP de l'utilisateur = ip
- Date d'inscription = inscription
- Dernière connexion = last_connect
- Rank du membre = rank
