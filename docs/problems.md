# Technische Probleme

## Beschreibung:

Hier werden alle technischen Probleme, welche während der Installation auftraten, erklärt. Zudem beschreiben wir hier unsere Lösungswege für diese Probleme. Linux-Probleme welche sich auf die VM beziehen, sind hier nicht dokumentiert. Bei Problemen mit der Linux-Umgebung siehe:  
Die[ Installationsanleitung für die Linux-VM's](http://wiki.suvanet.ch/display/FISE/RESTretto+Linux+Desktop+Setup)

### Composer install:

Nach dem Klonen des HyperShift-Projekts führten wir im Projektfolder `Composer install` aus. Bei Luca hat dies allerdings immer denselben Fehler ausgelöst.

![Composer Install Problem](.gitbook/assets/image%20%283%29.png)

Um dies zu beheben versuchten wir verschiedene Commands aus wie z.B: "php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider" oder "composer require laravel/jetstream". Auch damit konnten wir das Problem nicht beheben.

### PHP-Version:

Nach dem Installieren von PHP hatten wir eine alte PHP-Version 5.4 installiert. Als wir diese versuchten auf die Version 8.0.4 zu updaten funktioniert dies in dem Terminal in dem wir offen hatten. Sobald wir dieses jedoch geschlossen haben, ein neues geöffnet haben und mit `php -v` die Version überprüften, stand wieder Version 5.4. Das Problem war, dass wir keine Umgebungsvariablen ausserhalb der aktuellen Terminal-Session speichern konnten. Da wir nicht wussten wie man dieses Problem löst, haben wir dort sehr viel Zeit verloren. Schlussendlich konnte Jens uns helfen. Wir mussten mit `nano .bashrc` das .bashrc-File öffnen und die drei export-Befehle darin speichern. Somit werden diese mit jedem Shell-Launch ausgeführt.

![.bashrc-File](.gitbook/assets/image%20%285%29.png)

### Git-Version updaten:

Um mit dem Arbeiten anzufangen benötigten wir natürlich noch Git. Dieser Download funktioniert zwar ohne Probleme, jedoch installierte es uns die falsche Version. Darum mussten wir mithilfe von dieser Website Git nochmals über Source herunterladen. Jetzt haben wir beide die Version 2.10.1 welche auch nicht gerade neu ist aber mit dieser können wir wenigstens arbeiten.

![](.gitbook/assets/image%20%286%29.png)

### Npm und Node Versionen:

Auch die Node und die NPM Versionen haben uns Probleme gemacht, da wir immer zu alte Versionen installiert hatten. Um dies zu lösen haben wir folgende Commands gebraucht: 

1. `Nvm deactivate node` \(Um Node zu deaktivieren\) 
2. `sudo npm uninstall npm -g` \(Um npm zu deinstallieren\)
3. `nvm uninstall node` \(Um Node zu deinstallieren\)

Nach dem erneuten Installieren von Node mussten wir noch diesen Command ausführen, da sonst nach dem schliessen und wieder öffnen des Terminals node nicht mehr erkannt wurde. `nvm alias default 15.11.0`

