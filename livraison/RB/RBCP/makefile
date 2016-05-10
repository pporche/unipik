# version 1.02 date 10/05/2016 auteur(s) Sergi Colomies
# version 1.01 date 27/04/2016 auteur(s) Sergi Colomies
# version 1.00 date 25/04/2016 auteur(s) Sergi Colomies

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars 



all : imagespdf rbcp cleanrep cleaneps

imagespdf: 
	$(BASHMAKEPATH)/imagesPdf.sh $(IMGDIR) $(PDFDIR)/debriefing_L_Unipik_d16-05-23_rCP.pdf organigrammeFonctionnel modeleSpirale schemaArchitecture

rbcp : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements debriefing_L_Unipik_d16-05-23_rCP poster_L_Unipik_d16-05-23_rCP resumePic_L_Unipik_d16-05-23_rCP


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


