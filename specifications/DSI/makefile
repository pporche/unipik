# version 1.01, date 26/02/16, auteur Michel Cressant, Pierre Porche 
# Importation des variables
include makevars ../../makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : imagespdf dsi cleanrep cleaneps cleanpng

dsi : $(PDFDIR)/$(NOM_FICHIER).pdf 

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

# I have no idea what this thing is doing

imagespdf: $(IMGDIR)/schemaArchitecture.pdf

imagespng: $(IMGDIR)/fonctionsIDEF0.png

$(IMGDIR)/%.png: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=png $<

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<


# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf

# Nettoyage du répertoire
cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleaneps :
	rm -f images/*.eps
	rm -f images/*.pdf
	rm -f annexe/pdf/*.pdf

cleanpng:
	rm -f images/fonctionsIDEF0.png

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
