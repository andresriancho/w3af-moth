<%@ Page Language='C#' ContentType='text/html' ResponseEncoding='iso-8859-1'%>
<%@ Import Namespace="System.Data" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="refresh" content="2; url=./">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="Shortcut Icon" href="http://triptychstudios.net/images/favicon.ico" type="image/x-icon">
<title>TripychBlog :: Admin :: Signout</title>
<link href="styles.css" rel="stylesheet" type="text/css">
<body>
<script language="C#" runat=server>

void Page_Load(Object sender , EventArgs e) 
{
  FormsAuthentication.SignOut();
  Response.Redirect("login.aspx");
}

</Script>
</body>
</html>
