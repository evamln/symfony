## 🗒️ Barème :

Eva Molina

| **Barème**                           | **Points**| **Remarque**                               |**Points Obtenus**|
| :-----------------------------------:| :-------: | :-------------------------------------:    |:-:|
| Entités                              |     4     |                                            | 4 |
| Fixtures                             |     2     |                                            | 2 |
| Système de traduction                |     2     | Il n'y a pas de système pour changer la langue dans le site | 1 |
| Formulaires                          |     5     | Il y a un problème dans ton formulaire de personnage. Si je fais un nouveau personnage et que je choisis un "Stand" qui est déjà lié à un autre personnage ça ne fonctionne pas, car "Stand" est unique pour un personnage. Il aurait fallu dans ce cas ne pas n'afficher que les "Stand" disponibles. Une remarque qui ne compte pas pour la notation, c'est peu intuitif de modifier un formulaire et de n'avoir aucun message qui confirme que nos modifications sont prises en compte ou une redirection vers la page de listing.| 3 |
| Système de connexion                 |     3     | J'arrive bien à me connecter. Toutefois, tu n'as pas adapté le site si je suis connecté, je vois toujours "s'inscrire" et "se connecter". De plus, ton RegistrationFormType utilise un TextType pour l'email à la place d'un EmailType, je peux donc m'inscrire en mettant une chaîne de caractère classique alors que le form de login générer par le bundle me demande un email.| 1 |
| Tableau de bord                      |     2     |                                            | 2 |
| Création d'un EventCustom            |     2     | Je ne l'ai pas vu dans le projet.           | 0 |
| Code convention (points bonus)       |     2     | Petit détail un import non utilisé dans RegistrationController. Un conseil utilise bien les bonnes extensions dans ton IDE afin qu'il te le signale (peu importe le langage pas forcément en PHP). Comme ça, tu ne quittes aucun fichier avant de t'assurer que tout est parfait. À part ça, tu as bien respecté la convention de code de Symfony. | 2 |
| **Total**                            |   **22**  |                                            | 15|