Cahier des charges – What’s Your Kitty? 🎀

Membres de l’équipe

* Daria
* Amira

Description

What’s Your Kitty? est une application web de quiz de personnalité inspirée de l’univers kawaii.

L’utilisateur répond à une série de questions sur sa personnalité, ses habitudes, ses préférences et ses réactions dans différentes situations.

À la fin du quiz, l’application analyse l’ensemble de ses réponses et lui attribue la Kitty correspondant le mieux à son profil, par exemple : Boss Kitty, Kawaii Kitty, Lazy Kitty, Gamer Kitty, Study Kitty ou Travel Kitty.

Chaque Kitty possède une carte prédéfinie, avec une illustration au format SVG, un nom et une description de sa personnalité.

En complément de la Kitty obtenue, l’utilisateur reçoit plusieurs pourcentages représentant ses principaux traits de personnalité.

⸻

Fonctionnalités principales

1. Création de compte et authentification

L’utilisation du quiz nécessite un compte utilisateur afin de pouvoir sauvegarder les résultats.

Lors de son arrivée sur l’application, l’utilisateur peut :

* créer un compte ;
* se connecter à un compte existant ;
* se déconnecter ;
* modifier certaines informations de son profil.

Une fois connecté, il accède à son espace personnel et peut commencer le quiz.

Un e-mail de bienvenue est envoyé lors de la création du compte.

⸻

2. Quiz de personnalité

Le quiz est composé d’une série de questions affichées une par une.

Chaque question propose 4 réponses possibles et l’utilisateur doit sélectionner une seule réponse avant de passer à la question suivante.

Exemple :

Ton samedi idéal, c’est plutôt…

* Sortir et découvrir un nouvel endroit.
* Rester tranquillement chez moi devant une série.
* Avancer sur mes projets personnels.
* Faire du shopping et voir mes amis.

Les questions définitives et les réponses associées seront définies lors de la conception du quiz.

Une barre de progression indique à l’utilisateur son avancement dans le questionnaire.

⸻

3. Système de calcul des Kitty

Chaque réponse du quiz est associée à un certain nombre de points pour une ou plusieurs Kitty.

Par exemple, une réponse peut ajouter :

* +2 points à Travel Kitty ;
* +1 point à Kawaii Kitty.

À la fin du questionnaire, l’application additionne les points obtenus pour chaque Kitty.

La Kitty possédant le score total le plus élevé devient le résultat principal de l’utilisateur.

Plusieurs ensembles de réponses différents peuvent donc mener à la même Kitty.

Les associations entre les réponses et les Kitty sont prédéfinies et enregistrées dans la base de données.

En cas d’égalité entre plusieurs Kitty, une règle de départage prédéfinie sera appliquée afin que l’utilisateur obtienne toujours un résultat unique.

⸻

4. Traits de personnalité et pourcentages

En parallèle du calcul de la Kitty principale, les réponses influencent différents traits de personnalité.

Par exemple :

* Ambition
* Sociabilité
* Organisation
* Créativité
* Aventure
* Calme

Chaque réponse peut ajouter des points à un ou plusieurs de ces traits.

À la fin du quiz, les scores sont convertis en pourcentages afin de montrer à l’utilisateur à quel niveau chaque trait lui correspond.

Deux utilisateurs peuvent donc obtenir la même Kitty, mais avec des pourcentages différents selon les réponses qu’ils ont données.

Exemple :

Boss Kitty

* Ambition : 89 %
* Organisation : 76 %
* Sociabilité : 61 %
* Aventure : 42 %

Ces valeurs sont calculées automatiquement à partir des réponses données pendant le quiz.

⸻

5. Résultat et Kitty Card

À la fin du quiz, une page de résultat présente la Kitty Card de l’utilisateur.

La carte contient :

* le nom de la Kitty obtenue ;
* une illustration prédéfinie au format SVG ;
* une description de cette personnalité ;
* les différents traits de personnalité calculés ;
* les pourcentages correspondants.

L’illustration et les informations générales de chaque Kitty sont prédéfinies. Les pourcentages sont, eux, calculés individuellement pour chaque résultat.

⸻

6. Sauvegarde des résultats

Chaque fois qu’un utilisateur termine un quiz, son résultat est enregistré dans la base de données.

Le résultat sauvegardé contient notamment :

* l’utilisateur concerné ;
* la Kitty obtenue ;
* les différents scores/pourcentages obtenus ;
* la date et l’heure du quiz.

Les résultats restent liés au compte de l’utilisateur.

⸻

7. Historique des quiz

Depuis son profil, l’utilisateur dispose d’une page « Mes résultats ».

Cette page lui permet de consulter :

* le nombre de fois qu’il a réalisé le quiz ;
* la date de chaque tentative ;
* la Kitty obtenue lors de chaque tentative ;
* la Kitty Card associée ;
* les pourcentages obtenus lors de cette tentative.

L’utilisateur peut ouvrir un ancien résultat pour revoir sa Kitty Card complète.

Cet historique permet notamment de voir si sa personnalité et sa Kitty ont évolué entre plusieurs passages du quiz.

⸻

8. Refaire le quiz

Un utilisateur peut refaire le quiz autant de fois qu’il le souhaite.

Un nouveau résultat est créé à chaque tentative sans supprimer les précédents.

Il est ainsi possible, par exemple, d’obtenir Study Kitty lors d’un premier quiz puis Travel Kitty plusieurs mois plus tard tout en conservant les deux résultats dans l’historique.

⸻

9. Collection des Kitty

Une page « Toutes les Kitty » présente les différentes Kitty pouvant être obtenues.

Pour chaque Kitty sont affichés :

* son illustration ;
* son nom ;
* une courte description ;
* ses principaux traits caractéristiques.

Cette page ne révèle pas les réponses nécessaires pour obtenir chaque Kitty.

⸻

10. Administration

Un compte administrateur possède des droits supplémentaires.

L’administrateur peut gérer :

* les Kitty disponibles ;
* leurs descriptions et illustrations ;
* les questions du quiz ;
* les réponses proposées ;
* les points associés aux réponses ;
* les traits de personnalité ;
* les comptes utilisateurs.

Ces données peuvent ainsi être modifiées sans devoir changer directement le code du quiz.

⸻

11. Multilingue

L’application est disponible en :

* français ;
* anglais.

L’utilisateur peut changer la langue depuis l’interface.

Les principales pages et les éléments du quiz sont disponibles dans les deux langues.

⸻

Fonctionnalités optionnelles

Si le temps le permet :

* Partage de la Kitty Card : permettre à l’utilisateur de partager son résultat.
* Comparaison des résultats : comparer deux anciens résultats afin de visualiser l’évolution des traits de personnalité.
* Statistiques générales : afficher les Kitty les plus obtenues par l’ensemble des utilisateurs.
* Personnalisation du profil : avatar et autres éléments visuels.
* Animations : animation lors de la révélation de la Kitty obtenue.
* Filtres dans l’historique : rechercher les résultats selon la Kitty obtenue ou la date.
