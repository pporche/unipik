#!/bin/bash
#version 1.00, date 13/05/2016, auteur Matthieu Martins-Baltar
#inspiré du script new-service.sh a l'url https://gist.github.com/naholyr/4275302

echo "Assistant de maj de la traçabilité du fichier"
echo "---------------------------------------------"

#fonction pour demander une entrée utilisateur
prompt_token() {
  local VAL=""
  while [ "$VAL" = "" ]; do
    echo -n "${2:-$1} : "
    read VAL
    if [ "$VAL" = "" ]; then
      echo "Please provide a value"
    fi
  done
  VAL=$(printf '%q' "$VAL")
  eval $1=$VAL
}

#si pas de chemin, on en demande un
if [ "$1" = "" ]; then
    prompt_token 'fullfile'        "Emplacement du fichier à modifier (vous pouvez aussi utiliser \"${command} chemin/vers/le/fichier nouvelle.version\" )"
else
    fullfile=$1
fi

#si pas de version, on en demande une
if [ "$2" = "" ]; then
    prompt_token 'version'        "Nouvelle version du fichier (vous pouvez aussi utiliser \"${command} chemin/vers/le/fichier nouvelle.version\" )"
else
    version=$2
fi

#Découpage du chemin, en dossier, nom de fichier et extension
filename=$(basename "${fullfile}")
path=$(dirname "${fullfile}")
extension="${filename##*.}"
filename="${filename%.*}"

#Si le fichier n'existe pas, affichage d'une erreur
if [ ! -f "$fullfile" ]; then
  echo "Erreur: le fichier '$fullfile' n'existe pas"
  exit 1
fi

#si la variale $fullname n'est pas définie, on demande un nom
if [ "$fullname" = "" ]; then
    prompt_token 'fullname'        'Votre nom complet (pensez à définir la variable $fullname pour la prochaine fois)'
fi

#génération de la date et du commentaire de traçabilité
date=`date +%d/%m/%Y`
comment="version $version, date $date, auteur $fullname"

#modification du fichier selon l'extension
#formatage du commentaire différent selon l'extension
#sed <3
#man sed, si vous avez du mal à comprendre ce qu'il se passe.
if [ $extension = "sh" ]; then
    echo "Génération d'un fichier bash..."
    sed -i '/#!\/bin\/bash/d' "$fullfile"
    sed -i "1i#$comment" "$fullfile"
    sed -i '1i#!/bin/bash' "$fullfile"
elif [ $extension = "sql" ]; then
    echo "Génération d'un fichier sql..."
    sed -i "1i--$comment" "$fullfile"
elif [ $extension = "twig" ]; then
    echo "Génération d'un fichier twig..."
    sed -i "1i{# $comment #}" "$fullfile"
elif [ $extension = "php" ]; then
    echo "Génération d'un fichier php... (il est vivement recommandé d'utiliser un IDE à la place)"
    sed -i '/<?php/d' "$fullfile"
    sed -i "1i//$comment" "$fullfile"
    sed -i '1i<?php' "$fullfile"
elif [ $extension = "yml" ]; then
    echo "Génération d'un fichier yml..."
    sed -i "1i#$comment" "$fullfile"
fi
