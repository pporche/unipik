# version 1.00, date 14/09/2016, auteur Melissa Bignoux
# permet de verifier qu une adresse n a pas deja ete ajoutee

import mmap
import sys


adresseCherchee = sys.argv[1]
villeCherchee = sys.argv[2]
file = open('checkAdresses.txt', 'w+')
with file as fp:
	for line in fp:
	    if (adresseCherchee + " " +villeCherchee) == line:
	    	print "true"
	file.write(adresseCherchee + " " +villeCherchee)
	    
        