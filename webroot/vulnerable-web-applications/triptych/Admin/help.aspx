<%@ page language="C#" masterpagefile="admin.master" ContentType="text/html" ResponseEncoding="iso-8859-1" src="admin.cs" Inherits="Help"%>
<asp:content id="HelpHead" contentplaceholderid="AdminHead" runat="server">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="Shortcut Icon" href="../images/favicon.ico" type="image/x-icon" />
<link href="styles.css" rel="stylesheet" type="text/css">
<title><asp:Literal ID="Title" runat="server" /> :: Admin :: Help</title>
</head>
</asp:content>
<asp:content Id="Help" contentplaceholderid="AdminContent" runat="server">
<asp:Literal Id="litHelp" runat="server" /> 
</asp:content>

