#!/bin/bash

cd backend
find storage -name "[^.]*" -delete
rm -rf vendor
rm -rf .env .idea


cd ../frontend
rm -rf platforms plugins node_modules \
    .tmp .sass-cache .idea npm-debug.log
find hooks -name "[^R]*" -delete


cd ../
find . -name ".DS_Store" -delete
find . -name ".sw[mnpcod]" -delete
find . -name ".git.bak" | xargs rm -rf


# rm -rf .git backend/.git frontend/.git .release.sh
