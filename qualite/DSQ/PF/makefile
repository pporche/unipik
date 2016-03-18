# version 1.01 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.00 date 29/02/2016 auteur(s) Pierre Porche

# Importation des variables
include makevars ../../../makevars ../../../gestionConfigurations

all : pf cleanrep cleaneps

pf : $(PDFDIR)/$(NOM_FICHIER).pdf

$(PDFDIR)/%.pdf : %.tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv *.pdf $(PDFDIR)

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf
	rm -f images/*.pdf
	rm -f annexe/pdf/*.pdf

cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleaneps :
	rm -f images/*.eps

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
