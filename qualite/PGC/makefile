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

imagespdf: $(IMGDIR)/I_arboDeveloppement.pdf $(IMGDIR)/I_arboGestionProjet.pdf $(IMGDIR)/I_arboLivraison.pdf $(IMGDIR)/I_arboQualite.pdf $(IMGDIR)/I_arboRessources.pdf $(IMGDIR)/I_arboSpecifications.pdf $(IMGDIR)/I_arboTrunk.pdf

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
