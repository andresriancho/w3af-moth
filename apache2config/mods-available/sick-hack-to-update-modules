#!/bin/bash
for path in /usr/lib/apache2/modules/*.so; do 
        module=$(echo $path|sed -e 's/.*mod_\(.*\).so/\1/');
        if [ ! -e ${module}.load ]; then 
                module_name=${module}_module;
                echo "LoadModule $module_name $path" > ${module}.load; 
        fi; 
done
