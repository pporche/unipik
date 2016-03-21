# version 1.01 date 04/03/2016 auteur(s) Matthieu Martins-Baltar, Mathieu Medici

# Importation des variables
include makevars ../../../../makevars

all : imagespdf imagespng sp cleanrep cleaneps cleanpng

imagespdf: $(IMGDIR)/cycleCorrectionFT.pdf $(IMGDIR)/planningProjet2.pdf $(IMGDIR)/schemaArchitecture.pdf

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

imagespng: $(IMGDIR)/organigrammeFonctionnel.png $(IMGDIR)/cycleCorrectionFT.png $(IMGDIR)/modeleSpirale.png $(IMGDIR)/risque.png

$(IMGDIR)/%.png: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=png $<

sp : $(PDFDIR)/$(NOM_FICHIER).pdf 

$(PDFDIR)/%.pdf : %.tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH):$(THEMEPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

# Clean commands
clean : cleanpdf cleanrep cleaneps cleanpng

cleanpdf :
	rm -f pdf/*.pdf

cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0 *.nav *.snm

cleaneps :
	rm -f images/*.eps
	rm -f images/*.pdf
	rm -f annexe/pdf/*.pdf

cleanpng:
	rm -f images/*.png

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
