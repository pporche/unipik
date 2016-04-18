# version 1.02 date 18/04/2016 auteur(s) Pierre Porche
# version 1.00 date 01/03/2016 auteur(s) Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars



all : fr cleanrep cleaneps

fr : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements FR_Q_Unipik_rCPA_v1.00 FR_Q_Unipik_rCP_v1.00 FR_Q_Unipik_rRD_v1.00 FR_Q_Unipik_rRGC_v1.00 FR_Q_Unipik_rRQA_v1.00 FR_Q_Unipik_rRQ_v1.00 FR_Q_Unipik_rRRS_v1.00 


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


