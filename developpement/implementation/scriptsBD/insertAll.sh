# version 1.00, date 14/09/2016, auteur Mélissa Bignoux
# permet de remplir les tables adresses et établissement




echo "insertion adresses et établiemments"
./insertionsInDBEtablissementAdresses.sh

echo "insertions relatives à unicef 76"
./insertionsInDB76.sh

echo "insertions données tests"
./insertionsInDBDataTests.sh