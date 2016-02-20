# version 1.00, date 20/02/16, auteur Michel Cressant
# Compilation
all: Qualite Specifications Developpement

Qualite:
	make -C qualite

Specifications:
	make -C specifications

#Developpement:
#	make -C developpement


# Archivage
archive: archiveQualite archiveSpecifications archiveDeveloppement

archiveQualite:
	make -C qualite archive

archiveSpecifications:
	make -C specifications archive

archiveDeveloppement:
	make -C developpement archive


# Nettoyage
clean: cleanQualite cleanSpecification cleanDeveloppement

cleanQualite:
	make -C qualite clean

cleanSpecification:
	make -C specifications clean

cleanDeveloppement:
	make -C developpement clean

