/* Change this if the SERVER_NAME environment variable does not report
	the true name of your web server. */
#if 1
#define SERVER_NAME cgiServerName
#endif
#if 0
#define SERVER_NAME "www.boutell.com"
#endif

#include <stdio.h>
#include "cgic.h"
#include <string.h>
#include <stdlib.h>

void HandleSubmit();
void ShowForm();
void Name();

int cgiMain() {
	/* Send the content type, letting the browser know this is HTML */
	cgiHeaderContentType("text/html");
	/* Top of the page */
	fprintf(cgiOut, "<HTML><HEAD>\n");
	fprintf(cgiOut, "<TITLE>Buffer overflow test</TITLE></HEAD>\n");
	fprintf(cgiOut, "<BODY><H1>Buffer overflow test</H1>\n");
	/* If a submit button has already been clicked, act on the 
		submission of the form. */
	if ( cgiFormSubmitClicked("b0f") == cgiFormSuccess )
	{
		HandleSubmit();
		fprintf(cgiOut, "<hr>\n");
	}
	else
	{
		/* Now show the form */
		ShowForm();
	}

	/* Finish up the page */
	fprintf(cgiOut, "</BODY></HTML>\n");
	return 0;
}

void HandleSubmit()
{
	Name();
}

void Name() {
	char name[801];					
	cgiFormStringNoNewlines("name", name, 800);

	fprintf(cgiOut, "Name: ");
	cgiHtmlEscape(name);
	fprintf(cgiOut, "<BR>\n");

	char buf[10];		// b0f !!!
	strcpy(buf, name );   	// b0f !!!
	fprintf(cgiOut, "Buffer: ");
	cgiHtmlEscape(buf);
	fprintf(cgiOut, "<BR>\n");
	

}
	
void ShowForm()
{
	fprintf(cgiOut, "<!-- 2.0: multipart/form-data is required for file uploads. -->");
	fprintf(cgiOut, "<form method=\"POST\" ");
	fprintf(cgiOut, "	action=\"");
	cgiValueEscape(cgiScriptName);
	fprintf(cgiOut, "\">\n");
	fprintf(cgiOut, "<p>\n");
	fprintf(cgiOut, "Text Field containing Plaintext\n");
	fprintf(cgiOut, "<p>\n");
	fprintf(cgiOut, "<input type=\"text\" name=\"name\">Your Name\n");
	fprintf(cgiOut, "<p>\n");
	fprintf(cgiOut, "<input type=\"submit\" name=\"b0f\" value=\"Submit Request\">\n");
	fprintf(cgiOut, "<input type=\"reset\" value=\"Reset Request\">\n");
	fprintf(cgiOut, "</form>\n");
}

