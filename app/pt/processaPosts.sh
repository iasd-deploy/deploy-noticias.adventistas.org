#!/bin/bash

posts=$(wp post list --post_type=post --posts_per_page=10 --meta_key="post_processed" --meta_value="false" --meta_compare="NOT EXISTS" --format=ids)

echo ${posts[@]}

for p in ${posts[@]}; do
   wp post meta add $p post_processed false
   echo "Processando post ID - $(wp post get $p --field=ID) " 
   # wp post update $p --post_type=post
   wp post term add $p xtt-pa-format noticia
   wp post meta update $p post_processed true
done