#script pour supprimer les codes couleur d'un document.
#lancer ./suppression-couleur.sh fichier1.tex fichier2.tex ... dans le terminal où se trouve le script
#vérifier que la suppression s'est bien réalisée

mkdir brouillonsCouleurs
cp *.tex brouillonsCouleurs/

for i in $@
	do
	sed -i '/\\color{suppr}/,/\\color{\(ajout\|modif\|black\)}/d' $i
	sed -i 's/\\color{modif}//g' $i
	sed -i 's/\\color{ajout}//g' $i
	
	perl -0e '$_ = <>;s/\\textcolor{(?:modif|ajout)}({((?s:[^{}]++|(?1))*)})/$2/sg; s/\\textcolor{suppr}({((?s:[^{}]++|(?1))*)})//sg; open(FILE,">temp.txt"); print FILE; close(FILE);' $i
	mv temp.txt $i
done
