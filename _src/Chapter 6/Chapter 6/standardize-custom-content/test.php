<?php
print date('Y-m-dTH:i:s');
$filename = date('Y-m-dTH:i:s');
$myFile = '/Users/everett/Sites/wordpress3/log/'.$filename.'.actionslog';
$fh = fopen($myFile, 'a') or die("can't open file");

fwrite($fh, $stringData);

fclose($fh);

#print date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));
/*EOF*/