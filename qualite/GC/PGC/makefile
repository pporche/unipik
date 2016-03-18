# version 1.01, date 14/03/16, auteur Mathieu Medici, Pierre Porche
# Importation des variables
include makevars ../../../makevars ../../../gestionConfigurations

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : imagespdf pgc cleanrep cleaneps

pgc : $(PDFDIR)/$(NOM_FICHIER).pdf

$(PDFDIR)/$(NOM_FICHIER).pdf : $(VERSIONPGC)/$(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

imagespdf: $(VERSIONPGC)/$(IMGDIR)/arboDeveloppement.pdf $(VERSIONPGC)/$(IMGDIR)/arboDSQ.pdf $(VERSIONPGC)/$(IMGDIR)/arboGP.pdf $(VERSIONPGC)/$(IMGDIR)/arboLivraison.pdf $(VERSIONPGC)/$(IMGDIR)/arboQualite.pdf $(VERSIONPGC)/$(IMGDIR)/arboRessources.pdf $(VERSIONPGC)/$(IMGDIR)/arboSpecifications.pdf $(VERSIONPGC)/$(IMGDIR)/arboTrunk.pdf

$(IMGDIR)/%.pdf : $(VERSIONPGC)/$(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(VERSIONPGC)/$(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf
	rm -f $(VERSIONPGC)/images/*.pdf

# Nettoyage du répertoire
cleanrep:	
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof

cleaneps :
	rm -f $(VERSIONPGC)/images/*.eps

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
