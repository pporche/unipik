# version 1.01 date 30/03/2016 auteur(s) Michel Cressant
# version 1.00 date 24/02/2016 auteur(s) Pierre Porche, Michel Cressant

# Compilation
all: Lot1 Lot2

Lot1:
	make -C lot1

Lot2:
	make -C lot2



# Archivage
archive: archivelot1 archivelot2 

archivelot1:
	make -C lot1 archive

archivelot2:
	make -C lot2 archive


# Nettoyage
clean: cleanlot1 cleanlot2

cleanlot1:
	make -C lot1 clean

cleanlot2:
	make -C lot2 clean 
