#ExtraGeo GAME

###Standardisation
####Balise Head
```html
<title>ExtraGeo - La géographie amusante</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="ExtraGeo est un jeu multijoueur en ligne et gratuit. Défiez vos amis dans des duels dont seul vos connaissances du terrain vous aideront à vous surpasser !" />
<link rel="shortcut icon" href="/favicons.ico" />
<link rel="stylesheet" href="/style.css" type="text/css">
```
####Header
```html
<div class="page-header">
<h1 class="site-name">ExtraGeo</h1>
<div class="liens">
<a href="index.php" class="btn-header">Accueil</a>
<a href="login.php" class="btn-header">Se connecter</a>
<a href="inscription.php" class="btn-header">S'inscrire</a>
 </div>
</div>
```
####Footer
```html
<footer class="site-footer">
<span class="site-footer-owner">
<a href="http://topjeu.fr">ExtraGeo</a> est maintenu par <a href="https://github.com/AlphaZied" target="_blank">AlphaZied</a> &amp; <a href="https://github.com/OfficialAnti" target="_blank">OfficialAnti</a>.</span>
</footer>
```
###Technologies :
- Design (CSS3) : Inspiration de l'aspect de sites web 2.0 & Concept de l'Extra-Terrestre
- Communication client/serveur : Websockets (NodeJS) et éventuellement dans certains cas et pages Ajax
- Communication serveur/DB : PDO --> MySQL (prénommer les tables et colonnes)
- Dynamisme client du site : Javascript (& Jquery)

###Fonctionnalités :
1. **Champs de bataille** :
 * Version Beta : Capitales & Drapeaux contre le temps.
 * Version Finale : Capitales, Drapeaux, Présidents, Monuments, Langues parlées, Population & Puissance contre amis, temps ou recherche personne connectée aléatoire.
 * Diffusion d'une série d'infos anecdotiques sur le pays.
 * Mise en place des niveaux de difficultés et des gains d'XP.
2. **Espace membre (Home)** : 
 * Système d'amis (pour version finale)
 * Statistiques (parties jouées, perdues, gagnées, xp gagné) & Afficher niveau
 * Classement chaque semaine (en terme de Score)
 * Paramètres (modifier mot de passe & upload image profil)
3. **Panel** de connexion et d'inscription (avec récupération mot de passe, captcha, conservation session et mail de bienvenue)

###Codes couleurs :
- Bleu, vert, blanc (nuages + atmosphère)
- Bleu : #3a6786
- Vert : #54b551
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
