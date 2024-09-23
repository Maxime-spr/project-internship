READ ME

1er étape :
Installer le logiciel xampp, qui va permettre d'héberger le site de manière locale :
https://www.apachefriends.org/fr/download.html 

2eme étape :
Une fois installée prendre copier le fichier du projet dans le dossier htdocs de xampp:
   ![image](https://github.com/user-attachments/assets/eeb03d1c-46f1-4674-8dc1-02763c20ee29)
![image](https://github.com/user-attachments/assets/b3dce3f0-7e74-4e42-8da9-289c3a9edd04)


3eme étape :
Lancer le xampp control panel et lancer Apache et MySQL.
 ![image](https://github.com/user-attachments/assets/74d41240-7079-4c2b-9d1c-32da704a53a8)

4eme etape :
Se rendre sur le lien : http://localhost/dashboard/
Puis cliquer sur PHPMYADMIN
 ![image](https://github.com/user-attachments/assets/8b047548-c8a2-46dd-add5-bbecccf48b39)

Créer une nouvelle base de données nommée ‘project’ :
 ![image](https://github.com/user-attachments/assets/567b2fbe-9a54-42f8-a2b7-15887e9432bb)

Puis dans project une table appelée ‘users’ avec les mêmes variables ci-dessous:
 ![image](https://github.com/user-attachments/assets/a7b61c33-4b44-43a6-82a7-ebe8ff3535ed)

Enfin créer une deuxième table appelée ‘purchases’ comme ci-dessous :
 ![image](https://github.com/user-attachments/assets/fb4585ec-2c5b-4fbc-9f91-d13bbd3fc295)

Créer une troisième table nommée ‘rendezvous’
 ![image](https://github.com/user-attachments/assets/8168d68a-77ff-4e41-86ea-861b80203979)

5eme etape :
Installer PHP mailer
Il faut commencer par télécharger composer
Une fois fait, on installe avec cette commande :
composer require phpmailer/phpmailer
6ème étape :
Remplir les espaces libres du code.
Il faut changer l’adresse mail et les mots de passes liés au php mailer.
Il faut changer les clés secrètes liées à son compte stripe.
7ème étape :
Se rendre sur le lien suivant pour acceder au site en local :
http://localhost/project/client/index.php 
Vous devriez arriver sur cette page ou vous pourrez effectuer les tests de connexion, inscription et achats.
 
Pour la partie paiement voici le lien des cartes de paiement test lorsque vous voulez tester un paiement :
https://docs.stripe.com/testing?locale=fr-FR 

 
![image](https://github.com/user-attachments/assets/bde148dc-50c9-4bd9-9c70-a756ee75e45b)
