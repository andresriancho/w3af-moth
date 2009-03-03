<%@ page language="C#" masterpagefile="admin.master" ContentType="text/html" ResponseEncoding="iso-8859-1" src="admin.cs" Inherits="EditNews" validateRequest="false"%>

<asp:content id="EditNewsHead" contentplaceholderid="AdminHead" runat="server">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="styles.css" rel="stylesheet" type="text/css">
  <link rel="Shortcut Icon" href="../images/favicon.ico" type="image/x-icon" />
  <title><asp:Literal ID="Title" runat="server" /> :: Admin :: Edit News</title>
  </head>
</asp:content>
<asp:content id="EditNews" contentplaceholderid="AdminContent" runat="server">
  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="100%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><asp:TextBox ID="ArticleName" runat="server" Columns="40" CssClass="Textarea"/></td>
            <td><div align="right"><span class="Textarea">Hidden: </span>
                <asp:DropDownList ID="Hidden" runat="server" CssClass="Textarea">
                  <asp:ListItem value="No" text="No"/>
                  <asp:ListItem value="Yes" text="Yes"/>
                </asp:DropDownList>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><asp:TextBox ID="ArticleContent" Rows="6" Width="100%" TextMode="MultiLine" runat="server" CssClass="Textarea"/></td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="33%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><asp:Button ID="UpdateButton" Text="Save Changes" OnClick="UpdateButton_Click" runat="server" CssClass="Button"/>
                          <asp:Button ID="PreviewButton" Text="Preview" OnClick="PreviewButton_Click" runat="server" CssClass="Button"/></td>
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
        </table></td>
    </tr>
  </table>
  <div align="center"><br>
 <asp:DataGrid
  ID="Content"
  AutoGenerateColumns="False"
  CellPadding="4"
  BorderStyle="Solid"
  BorderWidth="1px"
  BorderColor="#FFFFFF"
  HeaderStyle-BackColor="#004D81"
  BackColor="#FFFFFF"
  AlternatingItemStyle-BackColor="#ecf9ff"
  Width="100%"
  Runat="Server">
            <Columns>
            <asp:TemplateColumn
	HeaderText="Comment #"
	ItemStyle-HorizontalAlign="Center"
	ItemStyle-CssClass="itemstyle"
	HeaderStyle-HorizontalAlign="Center"
	HeaderStyle-CssClass="headerstyle" >
              <itemTemplate> <a class="itemstyle" href="?Edit=<%#DataBinder.Eval(Container.DataItem, "CommentId")%>"><%#DataBinder.Eval(Container.DataItem, "CommentNumber")%></a> </itemTemplate>
            </asp:TemplateColumn>
            <asp:BoundColumn
    HeaderText="Author"
    DataField="CommentUserName"
	ItemStyle-HorizontalAlign="Center"
	ItemStyle-CssClass="itemstyle"
	HeaderStyle-HorizontalAlign="Center"
	HeaderStyle-CssClass="headerstyle" />
            <asp:BoundColumn
    HeaderText="IP Address"
    DataField="IPAddress"
	ItemStyle-HorizontalAlign="Center"
	ItemStyle-CssClass="itemstyle"
	HeaderStyle-HorizontalAlign="Center"
	HeaderStyle-CssClass="headerstyle" />
            <asp:BoundColumn
    HeaderText="Browser"
    DataField="BrowserType"
	ItemStyle-HorizontalAlign="Center"
	ItemStyle-CssClass="itemstyle"
	HeaderStyle-HorizontalAlign="Center"
	HeaderStyle-CssClass="headerstyle" />
            <asp:TemplateColumn
    HeaderText="Date"
	ItemStyle-HorizontalAlign="Center"
	ItemStyle-CssClass="itemstyle"
	HeaderStyle-HorizontalAlign="Center"
	HeaderStyle-CssClass="headerstyle" >
              <itemTemplate>
                <asp:Label ID="CommentDate"
                 Text='<%# (DataBinder.Eval(Container.DataItem, "CommentDate").ToString()).Substring(0,(DataBinder.Eval(Container.DataItem, "CommentDate").ToString()).Length-15) %>'
                 Runat="server" />
              </itemTemplate>
            </asp:TemplateColumn>
            <asp:TemplateColumn
	HeaderText="Select"
	ItemStyle-HorizontalAlign="Center"
	ItemStyle-CssClass="itemstyle"
	HeaderStyle-HorizontalAlign="Center"
	HeaderStyle-CssClass="headerstyle" >
              <itemTemplate>
                <asp:CheckBox ID="Select" runat="server" />
                <asp:Label ID="hdnCommentNumber"
                 Visible="False"
                 Text='<%# DataBinder.Eval(Container.DataItem, "CommentNumber") %>'
                 Runat="server" />
              </itemTemplate>
            </asp:TemplateColumn>
            </Columns>
          </asp:DataGrid>
    <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="left" class="Textarea">Pages: (1)&nbsp;&nbsp;[1] &nbsp;Next&nbsp;:&nbsp;Last &gt;</div></td>
        <td><div align="right"><span class="Textarea">With selected: </span>
            <asp:DropDownList ID="DBAction" runat="server" CssClass="Textarea">
              <asp:ListItem Text="Delete"/>
              <asp:ListItem Text="Block IP"/>
            </asp:DropDownList>
            <asp:Button ID="Go" runat="server" Text="Go" OnClick="GoButton_Click" CssClass="Button" />
          </div></td>
      </tr>
    </table>
  </div>
</asp:content>
