# version 2.00 date 01/05/2016 auteur(s) Sergi Colomies
# version 1.00 date 04/03/2016 auteur(s) Pierre Porche

# Compilation
all: Revues Rb

Revues:
	make -C revues

Rb:
	make -C RB


# Archivage
archive: archiverevues archiverb

archiverevues:
	make -C revues archive

archiverb:
	make -C RB archive


# Nettoyage
clean: cleanrevues cleanrb

cleanrevues:
	make -C revues clean

cleanrb:
	make -C RB clean
