#!/usr/bin/perl

if (length ($ENV{'QUERY_STRING'}) > 0) {
      $buffer = $ENV{'QUERY_STRING'};
      @pairs = split(/&/, $buffer);
      foreach $pair (@pairs) {
           ($name, $value) = split(/=/, $pair);
           $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
           $in{$name} = $value; 
      }
}
$c = $in{'c'};
print "Content-type: text/html\r\n\r\n";
print "The information inside the \"c\" query string parameter, which in this case is:<br/>
&nbsp;&nbsp;&nbsp;&nbsp;- $c <br/><br/>Is being evaluated.";
eval $c;
