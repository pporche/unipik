# version 1.01 date 18/04/2016 auteur(s) Pierre Porche
# version 1.00 date 29/02/2016 auteur(s) Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars


all : tb cleanrep cleaneps

tb : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements TB_Q_Unipik_s01 TB_Q_Unipik_s02 TB_Q_Unipik_s03 TB_Q_Unipik_s04 TB_Q_Unipik_s05 TB_Q_Unipik_s06 TB_Q_Unipik_s07 TB_Q_Unipik_s08 TB_Q_Unipik_s09 TB_Q_Unipik_s10 TB_Q_Unipik_s11 TB_Q_Unipik_s12 TB_Q_Unipik_s13 TB_Q_Unipik_s14 TB_Q_Unipik_s15 TB_Q_Unipik_s16 TB_Q_Unipik_s17 TB_Q_Unipik_s18 TB_Q_Unipik_s19 TB_Q_Unipik_s20 TB_Q_Unipik_s21 TB_Q_Unipik_s22 TB_Q_Unipik_s23 TB_Q_Unipik_s24 TB_Q_Unipik_s25


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


