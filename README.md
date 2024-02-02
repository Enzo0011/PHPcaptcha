# Projet API Captcha PHP

Ce projet PHP est une API de génération de captcha, conçue pour créer des images captcha personnalisables avec un texte aléatoire, une couleur de texte et une couleur de fond spécifiées par l'utilisateur, tout en assurant un contraste adéquat pour une lisibilité optimale. L'API est capable de gérer les requêtes HTTP GET pour récupérer les détails d'un captcha spécifique et POST pour générer un nouveau captcha avec des paramètres personnalisés.

## Comment Utiliser

1. **Clonage du Projet:**
   - Assurez-vous d'avoir Git installé sur votre machine.
   - Ouvrez un terminal et exécutez la commande suivante pour cloner le projet depuis GitHub :
     ```bash
     git clone https://github.com/Enzo0011/PHPcaptcha.git
     ```

2. **Configuration de l'Environnement:**
   - Configurez votre serveur web (Apache, Nginx, etc.) pour pointer vers le dossier du projet cloné.
   - Assurez-vous que PHP est installé et configuré correctement sur votre serveur.

3. **Utilisation de l'API:**
   - **Pour générer un captcha :** Envoyez une requête HTTP POST à l'endpoint de l'API avec les paramètres souhaités pour le texte, la couleur de texte, et la couleur de fond.
   - **Pour récupérer un captcha :** Envoyez une requête HTTP GET avec l'ID du captcha souhaité en tant que paramètre.

## Fonctionnalités
   - **Génération de Captcha :** Crée des images captcha avec un texte et des couleurs personnalisables, en veillant à ce que le texte reste lisible sur le fond choisi.
   - **Validation des Couleurs :** S'assure que les couleurs du texte et du fond fournies sont valides et que le contraste entre elles est suffisant.
   - **Sécurité :** Valide les requêtes entrantes à l'aide de tokens d'autorisation pour éviter les abus.
   - **Stockage des Captchas :** Enregistre les détails du captcha généré dans une base de données pour un accès ultérieur.
   - **Récupération de Captcha :** Permet de récupérer les détails d'un captcha spécifique en utilisant son ID unique.

## Remarques

- Ce projet nécessite une configuration préalable de la base de données et l'inclusion d'une police de caractères valide pour la génération d'images captcha.
- Assurez-vous d'ajuster les chemins des fichiers et des dossiers selon votre configuration serveur.
