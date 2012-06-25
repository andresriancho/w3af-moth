<?
header("Content-type:text/html; charset=euc-jp");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 </body>
         <head>
            <link rel="stylesheet" type="text/css" href="/w3af/default.css" title="default" />
            <!--
            We intentionally add this meta header. We expect that the browser and w3af actually uses "euc-jp" charset to decode this doc
            -->
            <meta http-equiv="Content-Type" content="text/html; charset=latin1">
            <title>Japanese charset tests</title>
        </head>
        <body> 
            <div id="body">
                 <h1 id="charset">
                    Japanese (<a href="http://www.rikai.com/library/kanjitables/kanji_codes.euc.shtml">euc-jp</a>) charset tests
                 </h1>
                 
                <ol>
                 <li>
                    Raw japanese query string (<a href="jap1.php?±Ð±Ñ±Ò±Ó±Ô±Õ±Ö±×">jap1.php?±Ð±Ñ±Ò±Ó±Ô±Õ±Ö±×</a>)<br/>
                 </li>
                 <li>
                    Url-encoded japanese query string (<a href="jap2.php?%B1%D0%B1%D1%B1%D2%B1%D3%B1%D4%B1%D5%B1%D6%B1%D7">jap2.php?%B1%D0%B1%D1%B1%D2%B1%D3%B1%D4%B1%D5%B1%D6%B1%D7</a>)<br/>
                 </li>
                 <li>
                    Encoded file name (<a href="%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%81%AE.html">¥Õ¥¡¥¤¥ë¤Î.html</a>)
                 </li>
               </ol>
             </div>
        </body>
</html>