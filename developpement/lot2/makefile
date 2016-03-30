# version 1.00 date 30/03/2016 auteur(s) Michel Cressant

# Compilation
all: dcp dt

dcp:
	make -C DCP

dt:
	make -C DT

# Archivage
archive: archivedcp archivedt

archivedcp:
	make -C DCP archive

archivedt:
	make -C DT archive

# Nettoyage
clean: cleandcp cleandt

cleandcp:
	make -C DCP clean

cleandt:
	make -C DT clean
