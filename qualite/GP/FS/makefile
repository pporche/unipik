# version 1.01 date 18/04/2016 auteur(s) Pierre Porche
# version 1.00 date 04/03/2016 auteur(s) Sergi Colomiès

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars



all : fs cleanrep cleaneps

fs : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements FS_Q_Unipik_pMC FS_Q_Unipik_pSC FS_Q_Unipik_pFD FS_Q_Unipik_pMB FS_Q_Unipik_pJP FS_Q_Unipik_pJR FS_Q_Unipik_pMMB FS_Q_Unipik_pPP FS_Q_Unipik_pFL FS_Q_Unipik_pKA 


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


