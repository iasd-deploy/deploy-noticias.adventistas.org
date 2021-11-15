#!/bin/bash

posts=$(wp post list --post_type=clipping --format=ids --allow-root)

for i in ${posts[@]}; do
	echo "Processando post ID - $(wp post get $i --field=ID --allow-root) " 
	wp post update $i --post_type=press  --allow-root
	wp post term add $i xtt-pa-press-type igreja-na-midia --allow-root
done

# clipping, release
