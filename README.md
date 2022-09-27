# Projet M2 ICONE Système de Diffusion — 1.00#

Ce dépôt contient le client SOAP de notre application XML/XSL/WebService. Le serveur applicatif devant être écrit en Java,
le langage du client n'était pas imposé donc PHP fût choisi.
Ce projet utilise Symfony Console et Soap Client de Zend Framework 2.

## Pré-requis ##

 * >= PHP 5.3.3
 * SOAP PHP extension

## Usage ##

Commencer par rendre éxecutable le client et découvrir son man :
    
    chmod u+x app/client
    app/client

Soumettre un document XML :

    app/client post --xml=fichier.xml

Récupérer un fichier XML :

    app/client get --id=1 --out=fichier.xml

Chercher un/des document(s) par mot-clé(s) :

    app/client search --keywords="foo, bar, baz yx"

Générer un document PDF à partir de son identifiant et de sa feuille de transformation :

    app/client makepdf --id=1 --xsl=transformer.xsl --out=fichier.pdf

## Infos ##
Copyright (c) 2011, Joris Berthelot

Joris Berthelot

Projet développé en une après-midi.
