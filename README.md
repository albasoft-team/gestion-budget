Projet Gestion Budget
========================
Ce projet gère les budgets alloués dans toutes les communes du pays.

Recupération du projet?
--------------

Pour recupérer le projet :
  * git clone **https://github.com/albasoft-team/gestion-budget.git**
  
  * Installer composer [**https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx**][1]

  * Se placer sur la racine du projet et et installer les packages symfony en tapant : **composer install** . Réponder les questions (information base de données,...);

  * Se placer dans le réportoire : web/front-end  et installer les packages angular en tapant : **bower install** et **npm install** 

  * Installer les assets en tapant : **php bin/console assets:install --symlink web**  ;

  * Vider le cache avec : **php bin/console cache:clear**
  
  * Exécuter l'application avec : **php bin/console server:run**


[1]:  https://symfony.com/doc/3.2/setup.html