# version 1.00, date 24/02/16, auteur Pierre Porche
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
