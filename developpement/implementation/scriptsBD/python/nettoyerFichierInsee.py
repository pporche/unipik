 #!/usr/bin/python
# -*- coding: utf-8 -*- 

import csv
import sys

def modifierContenuCellule(contenuCellule):
	accent = ['é', 'è', 'ê', 'à', 'ù', 'û', 'ç', 'ô', 'î', 'ï', 'â', 'ë']
	sans_accent = ['e', 'e', 'e', 'a', 'u', 'u', 'c', 'o', 'i', 'i', 'a', 'e']
	i = 0
	while i < len(accent):
		contenuCellule = contenuCellule.replace(accent[i], sans_accent[i])
		i += 1
	contenuCellule = contenuCellule.upper()
	contenuCellule = contenuCellule.replace('\'', ' ')
	return contenuCellule



with open('../../../ressources/client/eucircos_regions_departements_circonscriptions_communes_gps.csv', 'rb') as f:
     reader = csv.reader(f, delimiter=',') # good point by @paco
     fichierNettoye = open('../ressourcesNettoyees/eucircos_regions_departements_circonscriptions_communes_gps.csv', "wb")
     writer = csv.writer(fichierNettoye)
     listecsv = []
     for row in reader:
        row[2] = modifierContenuCellule(row[2])
        row[5] = modifierContenuCellule(row[5])
        row[8] = modifierContenuCellule(row[8])

        if (len(row[9])==4):
        	row[9] = ''.join(["0", row[9]])
        listecsv.append(row)
        
     writer.writerows(listecsv) 
     fichierNettoye.close()
     f.close()
             