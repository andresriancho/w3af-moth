#!/bin/bash

sudo rm -rf w3af/audit/file_upload/uploads/*
sudo rm -rf w3af/audit/dav/write-all/*
sudo git checkout w3af/audit/ssi/messages.shtml
sudo git checkout w3af/audit/xss/stored/data.txt
sudo chmod 777 w3af/audit/ssi/messages.shtml
sudo chmod 777 w3af/audit/xss/stored/data.txt
