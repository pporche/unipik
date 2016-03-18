# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 04/03/2016 auteur(s) Michel Cressant, Pierre Porche, Mathieu Medici

# Importation des variables
include makevars ../../makevars ../../gestionConfigurations

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : imagespdf dsi cleanrep cleaneps

imagespdf: $(IMGDIR)/schemaArchitecture.pdf

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

dsi : $(PDFDIR)/$(NOM_FICHIER).pdf 

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf

cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleaneps :
	rm -f images/*.eps
	rm -f images/*.pdf
	rm -f annexe/pdf/*.pdf

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
