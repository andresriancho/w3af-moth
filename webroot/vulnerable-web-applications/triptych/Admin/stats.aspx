<%@ page language="C#" masterpagefile="admin.master" ContentType="text/html" ResponseEncoding="iso-8859-1" src="admin.cs" Inherits="Stats.Default"%>

<asp:content id="OptionsHead" contentplaceholderid="AdminHead" runat="server">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="Shortcut Icon" href="../images/favicon.ico" type="image/x-icon" />
  <link href="styles.css" rel="stylesheet" type="text/css">
  <title><asp:Literal ID="Title" runat="server" /> :: Admin :: Stats</title>
  </head>
</asp:content>
<asp:content id="Options" contentplaceholderid="AdminContent" runat="server"> <h4>Browser Statistics</h4><img src="./browser.aspx" alt="Browser" />
</asp:content>
