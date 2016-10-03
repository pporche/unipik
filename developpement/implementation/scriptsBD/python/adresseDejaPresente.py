# version 1.00, date 14/09/2016, auteur Melissa Bignoux
# permet de verifier qu une adresse n a pas deja ete ajoutee

import mmap
import sys


adresseCherchee = sys.argv[1]
villeCherchee = sys.argv[2]
adresseTrouve = "false"
file = open('checkAdresses.txt', 'a+')
with file as fp:
	for line in fp:
	    if (adresseCherchee + " " +villeCherchee + " \n") == line:
	    	adresseTrouve = "true"

	if adresseTrouve == "false":	
		file.write(adresseCherchee + " " +villeCherchee + " \n")
	print(adresseTrouve)
	file.close()
	    
        