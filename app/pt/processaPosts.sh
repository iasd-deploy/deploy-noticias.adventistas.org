#!/bin/bash

posts=$(wp post list --post_type=post --posts_per_page=10000 --meta_key="post_processed" --meta_value="false" --meta_compare="NOT EXISTS" --format=ids --allow-root)

echo ${posts[@]}

for p in ${posts[@]}; do
   wp post meta add $p post_processed false --allow-root
   echo "Processando post ID - $(wp post get $p --field=ID --allow-root) " 
   # wp post update $p --post_type=post --allow-root
   wp post term add $p xtt-pa-format noticia --allow-root
   wp post meta update $p post_processed true --allow-root
done