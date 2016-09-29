# version 1.00, date 14/09/2016, auteur Melissa Bignoux
# permet de verifier que d associer les codes postaux aux villes

import csv
import sys

def main():
   ville = sys.argv[1].replace('-',' ')
   ville = ville.replace('SAINTE ', 'STE ')
   ville = ville.replace('SAINT ', 'ST ')
   with open('../ressourcesNettoyees/laposte_hexasmal.csv', 'rt') as f:
     reader = csv.reader(f, delimiter=',') # good point by @paco
     for row in reader:
          if ((row[3] == ville) or (row[4] == ville)):
            print(row[2])
          


 
main()



