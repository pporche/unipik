# version 1.01 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.00 date 29/02/2016 auteur(s) Michel Cressant

# Importation des variables
include makevars ../../../../../makevars ../../../../../gestionConfigurations

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf


# Compilation

all :  pti imagespdf cleanrep cleaneps

pti : $(PDFDIR)/$(NOM_FICHIER).pdf 


# LaTex to pdf
$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)



imagespdf:  $(IMGDIR)/modeleMVCPlusBD.pdf $(IMGDIR)/testControleurVue.pdf $(IMGDIR)/testControleurModele.pdf $(IMGDIR)/testModeleBD.pdf

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<


# Clean commands
clean : cleanpdf cleanrep  cleaneps

cleanpdf :
	rm -f pdf/*.pdf

# Nettoyage du répertoire
cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleaneps :
	rm -f images/*.eps
	rm -f images/*.pdf


# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
