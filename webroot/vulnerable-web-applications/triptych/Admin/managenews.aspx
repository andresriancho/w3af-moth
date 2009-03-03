<%@ page language="C#" masterpagefile="admin.master" ContentType="text/html" ResponseEncoding="iso-8859-1" src="admin.cs" Inherits="ManageNews"%>
<asp:content id="EditNewsHead" contentplaceholderid="AdminHead" runat="server">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="Shortcut Icon" href="../images/favicon.ico" type="image/x-icon" />
<title><asp:Literal ID="Title" runat="server" /> :: Admin :: Manage News</title>
</head>
</asp:content>
<asp:content id="EditNews" contentplaceholderid="AdminContent" runat="server">
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
			HeaderText="Title"
			ItemStyle-HorizontalAlign="Left"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Left"
			HeaderStyle-CssClass="headerstyle" >
				<itemTemplate>
					<a class="itemstyle" href="editnews.aspx?Edit=<%#DataBinder.Eval(Container.DataItem, "ArticleId")%>"><%#DataBinder.Eval(Container.DataItem, "ArticleName")%></a>
				</itemTemplate>
        </asp:TemplateColumn>
		<asp:BoundColumn
			HeaderText="Comments"
			DataField="ArticleComments"
			ItemStyle-HorizontalAlign="Center"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Center" 
			HeaderStyle-CssClass="headerstyle"/>
		 <asp:BoundColumn
			HeaderText="Category"
			DataField="Category"
			ItemStyle-HorizontalAlign="Center"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Center"
			HeaderStyle-CssClass="headerstyle" />
			<asp:BoundColumn
			HeaderText="Author"
			DataField="ArticleUserName"
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
					<asp:Label ID="ArticleDate" Text='<%# (DataBinder.Eval(Container.DataItem, "ArticleDate").ToString()).Substring(0,(DataBinder.Eval(Container.DataItem, "ArticleDate").ToString()).Length-15) %>' Runat="server" />
				</itemTemplate>
		</asp:TemplateColumn>
		<asp:BoundColumn
			HeaderText="Status"
			DataField="CommentProtection"
			ItemStyle-HorizontalAlign="Center"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Center"
			HeaderStyle-CssClass="headerstyle" />
        <asp:BoundColumn
			HeaderText="Hidden"
			DataField="Hidden"
			ItemStyle-HorizontalAlign="Center"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Center"
			HeaderStyle-CssClass="headerstyle" />
        <asp:TemplateColumn
			HeaderText="Select"
			ItemStyle-HorizontalAlign="Center"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Center"
			HeaderStyle-CssClass="headerstyle" >
          		<itemTemplate>
					<asp:CheckBox ID="Select" runat="server" />
					<asp:Label ID="hdnArticleId" Visible="False" Text='<%# DataBinder.Eval(Container.DataItem, "ArticleId") %>' Runat="server" />
				</itemTemplate>
        </asp:TemplateColumn>
    </Columns>
</asp:DataGrid>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="29"><div align="left" class="Textarea">Pages: (1)&nbsp;&nbsp;[1] &nbsp;Next&nbsp;:&nbsp;Last &gt;</div></td>
    <td><div align="right"><span  class="Textarea">With selected: </span>
        <asp:DropDownList ID="DBAction" runat="server" CssClass="Textarea">
          <asp:ListItem Text="Hide"/>
		  <asp:ListItem Text="Show"/>
          <asp:ListItem Text="Delete"/>
        </asp:DropDownList>
        <asp:Button ID="Go" runat="server" Text="Go" OnClick="GoButton_Click" CssClass="Button"/>
      </div></td>
  </tr>
</table>
				
</asp:content>