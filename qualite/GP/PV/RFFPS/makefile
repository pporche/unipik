# version 1.01 date 30/03/2016 auteur(s) Sergi Colomies
# version 1.00 date 20/02/2016 auteur(s) Sergi Colomies

# Compilation
all: pvfps pvdse pvptv

pvfps:
	make -C PVFPS

pvdse:
	make -C PVDSE

pvptv:
	make -C PVPTV

# Archivage
archive: archivepvfps archivepvdse archivepvptv

archivepvfps:
	make -C PVFPS archive

archivepvdse:
	make -C PVDSE archive

archivepvptv:
	make -C PVPTV archive

# Nettoyage
clean: cleanpvfps cleanpvdse cleanpvptv

cleanpvfps:
	make -C PVFPS clean

cleanpvdse:
	make -C PVDSE clean

cleanpvptv:
	make -C PVPTV clean
