#!/bin/bash
for i in $(wp user list --field=ID --network)
do
    echo "Usuario-> $i"
    ##wp user set-role $i subscriber --skip-packages

    ##wp user update $i --user_pass=pRYOt1D661Un7a4#ca2cxe
done
