# version 1.02 date 18/04/2016 auteur(s) Pierre Porche
# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars


all : fc cleanrep cleaneps

fc : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements FC_Q_Unipik_pFL_v1.02 FC_Q_Unipik_pJP_v1.02 FC_Q_Unipik_pKA_v1.02 FC_Q_Unipik_pMB_v1.02 FC_Q_Unipik_pMC_v1.02 FC_Q_Unipik_pMMB_v1.02 FC_Q_Unipik_pMM_v1.02 FC_Q_Unipik_pPP_v1.02 FC_Q_Unipik_pSC_v1.02 


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


