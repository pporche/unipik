#!/bin/bash
#version 1.01, date 13/05/2016, auteur Matthieu Martins-Baltar
#inspiré du script new-service.sh a l'url https://gist.github.com/naholyr/4275302

echo "Assistant de création de fichier"
echo "--------------------------------"

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
    prompt_token 'fullfile'        "Emplacement du nouveau fichier (vous pouvez aussi utiliser \"${command} chemin/vers/le/fichier\" )"
else
    fullfile=$1
fi

#Découpage du chemin, en dossier, nom de fichier et extension
filename=$(basename "${fullfile}")
path=$(dirname "${fullfile}")
extension="${filename##*.}"
filename="${filename%.*}"

#Si le fichier existe déjà, affichage d'une erreur
if [ -f "$fullfile" ]; then
  echo "Erreur: le fichier '$fullfile' existe déjà"
  exit 1
else
  if [ ! $path = "" ]; then
    mkdir -p "$path"
  fi
  touch "$fullfile"
fi

#si la variale $fullname n'est pas définie, on demande un nom
if [ "$fullname" = "" ]; then
    prompt_token 'fullname'        'Votre nom complet (pensez à définir la variable $fullname pour la prochaine fois)'
fi

#génération de la date et du commentaire de traçabilité
date=`date +%d/%m/%Y`
comment="version 1.00, date $date, auteur $fullname"

#génération du fichier selon l'extension
#formatage du commentaire différent selon l'extension
if [ $extension = "sh" ]; then
    echo "Génération d'un fichier bash..."
    echo "#!/bin/bash" >> "$fullfile"
    echo "#$comment" >> "$fullfile"
elif [ $extension = "sql" ]; then
    echo "Génération d'un fichier sql..."
    echo "--$comment" >> "$fullfile"
elif [ $extension = "twig" ]; then
    echo "Génération d'un fichier twig..."
    echo "{# $comment #}" >> "$fullfile"
elif [ $extension = "php" ]; then
    echo "Génération d'un fichier php... (il est vivement recommandé d'utiliser un IDE à la place)"
    echo "<?php" >> "$fullfile"
    echo "//$comment" >> "$fullfile"
elif [ $extension = "yml" ]; then
    echo "Génération d'un fichier yml..."
    echo "#$comment" >> "$fullfile"
fi




