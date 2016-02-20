# version 1.00, date 20/02/16, auteur Mathieu Medicis
# Importation des variables
include makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : imagespdf pgc cleanrep cleaneps

pgc : $(PDFDIR)/$(NOM_FICHIER).pdf

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

imagespdf: $(IMGDIR)/arboDeveloppement.pdf $(IMGDIR)/arboDSQ.pdf $(IMGDIR)/arboGP.pdf $(IMGDIR)/arboLivraison.pdf $(IMGDIR)/arboQualite.pdf $(IMGDIR)/arboRessources.pdf $(IMGDIR)/arboSpecifications.pdf $(IMGDIR)/arboTrunk.pdf

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf
	rm -f images/*.pdf

# Nettoyage du répertoire
cleanrep:	
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof

cleaneps :
	rm -f images/*.eps

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
