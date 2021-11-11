#!/bin/bash

posts=$(wp post list --post_type=colunas --format=ids)

for i in ${posts[@]}; do
	echo "Processando post ID - $(wp post get $i --field=ID) " 
	wp post update $i --post_type=post
	wp post term add $i xtt-pa-format artigo
done