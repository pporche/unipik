# version 1.01 date 18/04/2016 auteur(s) Pierre Porche
# version 1.00 date 29/02/2016 auteur(s) Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars


all : tb cleanrep cleaneps

tb : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements TB_Q_Unipik_s01 TB_Q_Unipik_s02 TB_Q_Unipik_s03 TB_Q_Unipik_s04 TB_Q_Unipik_s05 TB_Q_Unipik_s06 TB_Q_Unipik_s07 TB_Q_Unipik_s08 TB_Q_Unipik_s09 


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


