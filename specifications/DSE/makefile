# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars ../../makevars ../../gestionConfigurations

#.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : imagespng dse cleanrep cleaneps

dse : $(PDFDIR)/$(NOM_FICHIER).pdf

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

# I have no idea what this thing is doing
#imagespdf: $(IMGDIR)/ConduireLeProjet.pdf $(IMGDIR)/organigrammeHierarchiePic.pdf $(IMGDIR)/organigrammeProcessusPic.pdf $(IMGDIR)/ProcessusFournisseur.pdf $(IMGDIR)/RealiserProduits.pdf $(IMGDIR)/CycleFT_EpicUnity.pdf $(IMGDIR)/organigramme.pdf $(IMGDIR)/managerQualite.pdf

imagespng: $(IMGDIR)/modeleDUsage.png

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

$(IMGDIR)/%.png: $(IMGDIR)/%.uml
	$(UML) $(shell pwd)/$<

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
	rm -f images/*.png
	rm -f annexe/pdf/*.pdf

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
