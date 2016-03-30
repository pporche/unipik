# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars ../../makevars  ../../gestionConfigurations

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : imagespdf pro cleanrep cleaneps

pro : $(PDFDIR)/$(NOM_FICHIER).pdf

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

imagespdf:
	$(BASHMAKEPATH)/imagespdf.sh $(IMGDIR) nPourquoiFDR001 nPourquoiFDR002 nPourquoiFDR003 nPourquoiFDR004 nPourquoiFDR005 nPourquoiFDR006 nPourquoiFDR007 nPourquoiFDR008 nPourquoiFDR009 nPourquoiFDR010 nPourquoiFDR011 nPourquoiFDR012 nPourquoiFDR013 nPourquoiFDR014 nPourquoiFDR015 nPourquoiFDR016 nPourquoiFDO001 nPourquoiFDO002 nPourquoiFDO003 nPourquoiFDO004 nPourquoiFDO005 nPourquoiFDO006 nPourquoiFDO007


# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf
	rm -f images/*.pdf
	rm -f annexe/pdf/*.pdf

# Nettoyage du répertoire
cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleaneps :
	rm -f images/*.eps


