installation des roles:

sudo -E ansible-galaxy install -r requirements.yml #-E: pour avoir les paramètres de proxy http_proxy

pour déployer integ:


git clone http://mmartinsbaltar@monprojet.insa-rouen.fr/git/pic_unicef
vagrant up


pour déployer pre-prod:

git clone http://mmartinsbaltar@monprojet.insa-rouen.fr/git/pic_unicef pic_unicef-prod
cd pic_unicef-prod
git checkout Lotx
cd ..

ansible-playbook -i provisioning/inventory-pre-prod provisioning/playbook-pre-prod.yml -k -vvvv -K


pour déployer prod:

idem pre-prod, puis...

nano provisioning/vars/prod-secrets.yml # do NOT push !!
ansible-playbook -i provisioning/inventory-prod provisioning/playbook-prod.yml -k -vvvv -K

