# version 1.00 date 05/12/2016 auteur(s) Kafui Atanley

# Compilation
all: dcp dt

dcp:
	make -C DCP

dt:
	make -C DT

cdr:
	make -C CDR

# Archivage
archive: archivedcp archivedt archivecdr

archivedcp:
	make -C DCP archive

archivedt:
	make -C DT archive

archivecdr:
	make -C CDR archive

# Nettoyage
clean: cleandcp cleandt cleancdr

cleandcp:
	make -C DCP clean

cleandt:
	make -C DT clean

cleancdr:
	make -C CDR clean
