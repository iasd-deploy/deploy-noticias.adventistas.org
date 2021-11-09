mkdir temp
cd temp
rm -rf ./*
curl https://www.wonderplugin.com/download/wonderplugin-lightbox-free.zip --output wonderplugin-lightbox-free.zip
unzip wonderplugin-lightbox-free.zip
cp -a ./wonderplugin-lightbox ../pt/wp-content/plugins/
cp -a ./wonderplugin-lightbox ../es/wp-content/plugins/
cd ../ 
rm -rf temp
cd pt/ && wp plugin update --all --allow-root && wp core language update --allow-root
cd ../
cd es/ && wp plugin update --all --allow-root && wp core language update --allow-root