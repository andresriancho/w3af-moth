#!/usr/bin/env python

import cgi

inputs = cgi.FieldStorage()

c = ""

if inputs.has_key('c'):
  c = inputs['c'].value

print "Content-type: text/html\r\n\r\n"
print "The information inside the \"c\" query string parameter, which in this case is:<br/>"
print "&nbsp;&nbsp;&nbsp;&nbsp;- " + c + "<br/><br/>Is being evaluated."
exec c
