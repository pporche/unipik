#!/bin/bash
# Imagespdf script

NAME="$1"

$(DIA) -e $(IMGDIR)/$(NAME).eps --filter=eps-builtin $(IMGDIR)/$(NAME).dia

$(EPSPDF) -dEPSCrop $(IMGDIR)/$(NAME).eps $(IMGDIR)/$(NAME).pdf
