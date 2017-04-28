#!/bin/sh

export LANG=zh_CN.UTF-8

git pull
git checkout dev
composer update
