# version 1.00 date 24/02/2016 auteur(s) Pierre Porche, Michel Cressant

# Compilation
all: Lot1 dt

Lot1:
	make -C lot1

dt:
	make -C DT



# Archivage
archive: archivelot1 archivedt

archivelot1:
	make -C lot1 archive

archivedt:
	make -C DT archive



# Nettoyage
clean: cleanlot1 cleandt

cleanlot1:
	make -C lot1 clean

cleandt:
	make -C DT clean

