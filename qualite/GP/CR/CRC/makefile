# version 1.02 date 18/04/2016 auteur(s) Pierre Porche
# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars 



all : crtq cleanrep cleaneps


crtq :
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements CRC_Q_Unipik_d16-01-26 CRC_Q_Unipik_d16-02-03 CRC_Q_Unipik_d16-10-06


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


