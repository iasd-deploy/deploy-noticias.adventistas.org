<?php header("HTTP/1.0 404 Not Found"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>404 Not Found</title></head>
<body><h1>404 Not Found</h1>
<p>The requested URL /<?php if ($_SERVER['QUERY_STRING']) : echo $_SERVER['QUERY_STRING']; endif; ?> was not found on this server.</p>
<p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p>
</body></html>
