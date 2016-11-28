# version 1.01 date 11/03/2016 auteur(s) Pierre Porche

# Compilation
all: dcp dcd dt cdr


dcp:
	make -C DCP
dcd:
	make -C DCD
dt:
	make -C DT
cdr:
	make -C CDR



# Archivage
archive: archivedcp archivedcd archivedt archivecdr


archivedcp:
	make -C DCP archive

archivedcd:
	make -C DCD archive

archivedt:
	make -C DT archive

archivecdr:
	make -C CDR archive



# Nettoyage
clean: cleandcp cleandcd cleandt cleancdr


cleandcp:
	make -C DCP clean

cleandcd:
	make -C DCD clean

cleandt:
	make -C DT clean

cleancdr:
	make -C CDR clean

