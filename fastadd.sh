#!/bin/bash


echo "Commit Kommentar"
read TestEingabe
if [ "$TestEingabe" == "" ]
then
echo "Kein Kommentar,da geht nichts"
else
git add .
git commit -m "$TestEingabe"
git push
echo "Add,Commit,Push done"
fi
