# Importation des variables
include makevars

#.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : dse cleanrep cleaneps

dse : $(PDFDIR)/$(NOM_FICHIER).pdf

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

# I have no idea what this thing is doing
#imagespdf: $(IMGDIR)/ConduireLeProjet.pdf $(IMGDIR)/organigrammeHierarchiePic.pdf $(IMGDIR)/organigrammeProcessusPic.pdf $(IMGDIR)/ProcessusFournisseur.pdf $(IMGDIR)/RealiserProduits.pdf $(IMGDIR)/CycleFT_EpicUnity.pdf $(IMGDIR)/organigramme.pdf $(IMGDIR)/managerQualite.pdf

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

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
