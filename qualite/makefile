# version 1.00 date 20/02/2016 auteur(s) Michel Cressant

# Compilation
all: pro gp dsq gc pq

pro:
	make -C PRO

pq:
	make -C PQ

gp:
	make -C GP

dsq:
	make -C DSQ

gc:
	make -C GC



# Archivage
archive: archivepq archivepro archivegp archivedsq archivegc

archivepq:
	make -C PQ archive

archivepro:
	make -C PRO archive

archivegp:
	make -C GP archive

archivedsq:
	make -C DSQ archive

archivegc:
	make -C GC archive


# Nettoyage
clean: cleanpq cleanpro cleangp cleandsq cleangc

cleanpq:
	make -C PQ clean

cleanpro:
	make -C PRO clean

cleangp: 
	make -C GP clean

cleandsq:
	make -C DSQ clean

cleangc:
	make -C GC clean
