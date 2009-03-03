<%@ Page Language="C#" ContentType="text/html" ResponseEncoding="iso-8859-1" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>TriptychBlog :: Admin :: Login</title>
<link rel="Shortcut Icon" href="../images/favicon.ico" type="image/x-icon" />
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<script runat="server">
void loginButton_Click(Object sender , EventArgs e) 
{
	if ( IsValid )
	{
		if ( FormsAuthentication.Authenticate( Username.Text, Password.Text ) )
		{
			FormsAuthentication.RedirectFromLoginPage( Username.Text, false );
		}
		else
		{
			Message.Text = "Invalid Username or Password";
		}
	}
}

</script>
<form runat="server">
  <div align="center">
    <div id="containerLogin">
      <div id="navigation">TriptychBlog Login</div>
      <div id="content"> 
	  <div class="Textarea">
	    Username:
        <br /><asp:TextBox ID="Username" runat="server" CssClass="Textarea"/></div>
        <div class="Textarea">Password:
        <br /><asp:TextBox ID="Password" runat="server" CssClass="Textarea" TextMode="Password"/></div>
        <asp:Button ID="Sign_In" Text="Sign In" runat="server" OnClick="loginButton_Click" CssClass="Button"/>
      </div>
      <div id="footer">
        <p>
          <asp:Label ID="Message" Font-Name="Verdana" ForeColor="#00A8FF" Font-Size="8" runat="server" />
        </p>
      </div>
    </div>
  </div>
</form>
</body>
</html>
