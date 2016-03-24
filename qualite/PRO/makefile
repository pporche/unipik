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

imagespdf: $(IMGDIR)/nPourquoiFDO001.pdf $(IMGDIR)/nPourquoiFDO002.pdf $(IMGDIR)/nPourquoiFDO003.pdf $(IMGDIR)/nPourquoiFDO004.pdf $(IMGDIR)/nPourquoiFDO005.pdf $(IMGDIR)/nPourquoiFDO006.pdf $(IMGDIR)/nPourquoiFDO007.pdf $(IMGDIR)/nPourquoiFDR001.pdf $(IMGDIR)/nPourquoiFDR002.pdf $(IMGDIR)/nPourquoiFDR003.pdf $(IMGDIR)/nPourquoiFDR004.pdf $(IMGDIR)/nPourquoiFDR005.pdf $(IMGDIR)/nPourquoiFDR006.pdf $(IMGDIR)/nPourquoiFDR007.pdf $(IMGDIR)/nPourquoiFDR008.pdf $(IMGDIR)/nPourquoiFDR009.pdf $(IMGDIR)/nPourquoiFDR010.pdf $(IMGDIR)/nPourquoiFDR011.pdf $(IMGDIR)/nPourquoiFDR012.pdf $(IMGDIR)/nPourquoiFDR013.pdf $(IMGDIR)/nPourquoiFDR014.pdf

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

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


