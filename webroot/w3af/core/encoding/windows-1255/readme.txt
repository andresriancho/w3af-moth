Follow these steps to generate the windows-1255/index.html file


moth@moth:/var/www/w3af/core/encoding/windows-1255$ sudo python
Python 2.6.2 (release26-maint, Apr 19 2009, 01:56:41) 
[GCC 4.3.3] on linux2
Type "help", "copyright", "credits" or "license" for more information.
>>> import urllib
>>> html = u'''<html>
...     <head>
...         <meta http-equiv=Content-Type content="text/html; charset=Windows-1255">
...         <title>Hebrew charset tests</title>
...     </head>
...     <body> 
...         <div id="body">
...              <h2 id="charset">
...                 Hebrew charset tests
...              </h2>
...              
...             <ul>
...              <li>
...                 Raw hebrew query string (<a href="heb1.php?באתר">heb1.php?באתר</a>)<br/>
...              </li>
...              <li>
...                 Url-encoded hebrew query string (<a href="heb2.php?%D7%91%D7%90%D7%AA%D7%A8">heb2.php?%D7%91%D7%90%D7%AA%D7%A8</a>)<br/>
...              </li>
...              <li>
...                 Encoded file name (<a href="%D7%A7%D7%95%D7%91%D7%A5.html">קובץ.html</a>)
...              </li>
...            </ul>
...          </div>
...     </body>
... </html>'''
>>> 
>>> f = open('index.html', 'wb')
>>> f.write(html.encode('Windows-1255'))
>>> f.close()

