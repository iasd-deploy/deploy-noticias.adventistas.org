#!/bin/bash

posts=$(wp post list --post_type=post --posts_per_page=$2 --paged=$1 --meta_key="post_processed" --meta_value="false" --meta_compare="NOT EXISTS" --format=ids --allow-root)
CONTER=1
# echo ${posts[@]}

for p in ${posts[@]}; do
   time wp post term add $p xtt-pa-format noticia --allow-root
   echo " $CONTER - FIM do post ID - $p" 
   CONTER=$[$CONTER + 1]
   
   wp post meta update $p post_processed true --allow-root
done