#!/bin/sh

npm install
if [ $PION_EXMPL_DEBUG ] ; then
    echo "========== ========== ========== gulp watch"
    gulp watch
else
    echo "========== ========== ========== gulp build"
    gulp build
fi;
