#!/bin/sh
#Descomprimos el tar en el directorio donde está el tar ( /data/temp )
mkdir ./collegium
tar -vxf collegium.tar.gz --directory collegium 2> errores.log

#Ahora creamos el directorio destino
rm -r -f /data/public_html/collegium
mkdir /data/public_html/collegium

#Pasamos los datos al directorio público
mv ./collegium/ /data/public_html

#production presets
cp -R /data/public_html/collegium/production/server1/. /data/public_html/collegium

#permissions
chmod 755 -R /data/public_html/collegium
chmod 775 -R /data/public_html/collegium/storage
chown www-data:www-data -R /data/public_html/collegium

#Storage
rm -r /data/public_html/collegium/public/storage
cd /data/public_html/collegium
php artisan storage:link
