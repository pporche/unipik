# version 1.02, date 11/04/16, auteur Michel Cressant, Pierre Porche
# Compilation
all: Qualite Specifications Developpement Livraison

Qualite:
	make -C qualite

Specifications:
	make -C specifications

Developpement:
	make -C developpement

Livraison:
	make -C livraison


# Archivage
archive: archiveQualite archiveSpecifications archiveDeveloppement archiveLivraison

archiveQualite:
	make -C qualite archive

archiveSpecifications:
	make -C specifications archive

archiveDeveloppement:
	make -C developpement archive

archiveLivraison:
	make -C livraison archive


# Nettoyage
clean: cleanQualite cleanSpecification cleanDeveloppement cleanLivraison

cleanQualite:
	make -C qualite clean

cleanSpecification:
	make -C specifications clean

cleanDeveloppement:
	make -C developpement clean

cleanLivraison:
	make -C livraison clean

