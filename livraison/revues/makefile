# version 1.00 date 04/03/2016 auteur(s) Pierre Porche

# Compilation
all: revueUn revueDeux

revueUn:
	make -C revue1

revueDeux:
	make -C revue2




# Archivage
archive: archiverevueUn archiverevueDeux

archiverevueUn:
	make -C revue1 archive

archiverevueDeux:
	make -C revue2 archive





# Nettoyage
clean: cleanrevueUn cleanrevueDeux

cleanrevueUn:
	make -C revue1 clean

cleanrevueDeux:
	make -C revue2 clean

