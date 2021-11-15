#!/bin/bash

posts=$(wp post list --post_type=colunas --format=ids --allow-root)

for i in ${posts[@]}; do
	wp post meta add $i post_processed false --allow-root
	echo "Processando post ID - $(wp post get $i --field=ID --allow-root) " 
	wp post update $i --post_type=post --allow-root
	wp post term add $i xtt-pa-format artigo --allow-root
	wp post meta update $i post_processed true --allow-root
done