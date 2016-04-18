# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 14/03/2016 auteur(s) Mathieu Medici, Pierre Porche

# Importation des variables
include makevars ../../../makevars ../../../gestionConfigurations

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : imagespdf pgc cleanrep cleaneps


imagespdf:
	$(BASHMAKEPATH)/imagesPdf.sh $(IMGDIR) $(PDFDIR)/$(NOM_FICHIER).pdf arboDeveloppement arboDSQ arboGP arboLivraison arboQualite arboRessources arboSpecifications arboTrunk



pgc : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) . $(NOM_FICHIER)


# Archivage
archive:
	$(BASHMAKEPATH)/archivage.sh ${ARCHIVEDIR}

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	$(BASHMAKEPATH)/cleanPdf.sh pdf images annexe/pdf

# Nettoyage du répertoire
cleanrep:
	$(BASHMAKEPATH)/cleanRep.sh

cleaneps :
	$(BASHMAKEPATH)/cleanEps.sh


