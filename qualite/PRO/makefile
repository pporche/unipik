# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars  $(UNIPIKGENPATH)/pic_unicef/gestionConfigurations

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf


all : imagespdf pro cleanrep cleaneps


imagespdf:
	$(BASHMAKEPATH)/imagesPdf.sh $(IMGDIR) $(PDFDIR)/$(NOM_FICHIER).pdf nPourquoiFDR001 nPourquoiFDR002 nPourquoiFDR003 nPourquoiFDR004 nPourquoiFDR005 nPourquoiFDR006 nPourquoiFDR007 nPourquoiFDR008 nPourquoiFDR009 nPourquoiFDR010 nPourquoiFDR011 nPourquoiFDR012 nPourquoiFDR013 nPourquoiFDR014 nPourquoiFDR015 nPourquoiFDR016 nPourquoiFDO001 nPourquoiFDO002 nPourquoiFDO003 nPourquoiFDO004 nPourquoiFDO005 nPourquoiFDO006 nPourquoiFDO007


pro:
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) $(NOM_FICHIER)


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


