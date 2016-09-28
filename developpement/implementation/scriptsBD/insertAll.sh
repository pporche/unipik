# version 1.00, date 14/09/2016, auteur Mélissa Bignoux
# permet de remplir les tables adresses et établissement

echo "netooyage du fichier csv"
python python/nettoyerFichierInsee.py

echo "insertion données France"
./insertionsInDBDonneesFrance.sh

echo "insertion adresses"
./insertionsInDBAdresse.sh

echo "insertion établissements et modification des adresses (ajout de la géolocalisation)"
./insertionsInDBEtablissement.sh

echo "insertions relatives à unicef 76"
./insertionsInDB76.sh

echo "insertions données tests"
./insertionsInDBDataTests.sh