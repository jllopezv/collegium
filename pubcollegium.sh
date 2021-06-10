#!/bin/sh
#
# ESTE ARCHIVO DEBE SITUARSE EN EL SERVIDOR DONDE SE INSTALARA EN /data/temp JUNTO CON EL ARCHIVO COMPRIMIDO
#
#Descomprimos el tar en el directorio donde está el tar ( /data/temp )
mkdir ./collegium
tar -vxf collegium.tar.gz --directory collegium
#movemos el directorio dentro de data
rm -r -f /data/collegium
mkdir /data/collegium
mv ./collegium/ /data
#Ahora creamos el public
rm -r -f /data/public_html/collegium
mkdir /data/public_html/collegium
#Pasamos los datos al directorio público
cp -R /data/collegium/public/. /data/public_html/collegium
rm -r -f /data/collegium/public
#production presets
cp /data/collegium/production/server1/index.php /data/public_html/collegium
cp /data/collegium/production/server1/.env /data/public_html/collegium
#permissions
sudo chown www-data:www-data -R /data/public_html/collegium
sudo chown www-data:www-data -R /data/collegium
sudo chmod g+w -R /data/public_html/collegium
sudo chmod g+w -R /data/collegium
