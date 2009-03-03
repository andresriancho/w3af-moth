<%@ page language="C#" masterpagefile="admin.master" ContentType="text/html" ResponseEncoding="iso-8859-1" src="admin.cs" Inherits="AddNews" validateRequest="false"%>

<asp:content id="AddNewsHead" contentplaceholderid="AdminHead" runat="server">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="Shortcut Icon" href="../images/favicon.ico" type="image/x-icon" />
  <link href="styles.css" rel="stylesheet" type="text/css">
  <title><asp:Literal ID="Title" runat="server" /> :: Admin :: Add News</title>
  </head>
</asp:content>
<asp:content id="AddNews" contentplaceholderid="AdminContent" runat="server">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="100%" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><asp:TextBox ID="ArticleName" runat="server" Columns="40" CssClass="Textarea"/></td>
                        <td><div align="right"><span class="Textarea">Hidden: </span>
                            <asp:DropDownList ID="Hidden" runat="server" CssClass="Textarea">
                              <asp:ListItem value="No" text="No" />
                              <asp:ListItem value="Yes" text="Yes" />
                            </asp:DropDownList>
                          </div></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td><asp:TextBox ID="ArticleContent" Rows="6" Width="100%" TextMode="MultiLine" runat="server" CssClass="Textarea"/></td>
          </tr>
          <tr>
            <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><asp:Button ID="dbButton" Text="Add Article" OnClick="AddButton_Click" runat="server" CssClass="Button"/>
                    <asp:Button ID="PreviewButton" Text="Preview" OnClick="PreviewButton_Click" runat="server" CssClass="Button"/>
                  </td>
                  <td><div align="right"><span class="Textarea">Category: </span>
                      <asp:DropDownList ID="Category" runat="server" CssClass="Textarea"></asp:DropDownList>
                    </div></td>
                  <td><div align="right"><span class="Textarea">Comments: </span>
                      <asp:DropDownList ID="Comments" runat="server" CssClass="Textarea">
                        <asp:ListItem value="Open" Text="Open"/>
                        <asp:ListItem value="Protected" Text="Protected"/>
                        <asp:ListItem value="Locked" Text="Locked"/>
                      </asp:DropDownList>
                    </div></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</asp:content>
