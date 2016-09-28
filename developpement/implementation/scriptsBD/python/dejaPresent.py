# version 1.00, date 14/09/2016, auteur Melissa Bignoux
# permet de verifier si un mot est present

import mmap
import sys

motCherche = sys.argv[1]
file = open('presents.txt', "a+")
with file as f:
    data = f.read()
    if ("mot : " + motCherche + " \n")in data:
        print("true")
    else: 
    	print("false")
    	f.write("mot : " + motCherche + " \n")
    f.close()