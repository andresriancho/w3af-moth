<%@ page language="C#" masterpagefile="admin.master" ContentType="text/html" ResponseEncoding="iso-8859-1" src="admin.cs" Inherits="Default"%>
<asp:content id="HomeHead" contentplaceholderid="AdminHead" runat="server">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="Shortcut Icon" href="../images/favicon.ico" type="image/x-icon" />
<link href="styles.css" rel="stylesheet" type="text/css">
<title><asp:Literal ID="Title" runat="server" /> :: Admin</title>
</head>
</asp:content>
<asp:content id="Home" contentplaceholderid="AdminContent" runat="server">
<h2>Welcome</h2>
<p>Hello, <asp:Literal ID="lblName" runat="server" />   <br />           

  Microsoft ASP.net Framework v2.0  is Required.
</p>
  </asp:content>
