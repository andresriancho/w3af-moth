<%@ page language="C#" masterpagefile="admin.master" ContentType="text/html" ResponseEncoding="iso-8859-1" src="admin.cs" Inherits="Options"%>

<asp:content id="OptionsHead" contentplaceholderid="AdminHead" runat="server">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link rel="Shortcut Icon" href="../images/favicon.ico" type="image/x-icon" />
  <link href="styles.css" rel="stylesheet" type="text/css">
  <title><asp:Literal ID="litTitle" runat="server" /> :: Admin :: Options</title>
  </head>
</asp:content>
<asp:content id="Options" contentplaceholderid="AdminContent" runat="server">
  <h4>Global</h4>
  <table cellspacing="0" cellpadding="4" rules="all" border="1" id="ctl00_AdminContent_Category" style="background-color:White;border-color:White;border-width:1px;border-style:Solid;border-collapse:collapse;">
    <tr style="background-color:#004D81;">
      <td class="headerstyle" align="left">Settings</td>
      <td class="headerstyle" align="center"></td>
    </tr>
    <tr>
      <td class="itemstyle" align="left">Title:</td>
      <td class="itemstyle" align="left"><asp:TextBox id="Title" runat="server" Columns="40" /></td>
    </tr>
    <tr style="background-color:#ECF9FF;">
      <td class="itemstyle" align="left">Description:</td>
      <td class="itemstyle" align="left"><asp:TextBox id="Description" runat="server" Columns="40" /></td>
    </tr>
    <tr>
      <td class="itemstyle" align="left">Language:</td>
      <td class="itemstyle" align="left"><asp:TextBox id="Language" runat="server" Columns="20" /></td>
    </tr>
    <tr style="background-color:#ECF9FF;">
      <td class="itemstyle" align="left">Display:</td>
      <td class="itemstyle" align="left"><asp:TextBox id="Display" runat="server" Columns="3"/></td>
    </tr>
    <tr>
      <td class="itemstyle" align="left">Recent Display:</td>
      <td class="itemstyle" align="left"><asp:TextBox id="RecentDisplay" runat="server" Columns="3" /></td>
    </tr>
    <tr style="background-color:#ECF9FF;">
      <td class="itemstyle" align="left">Host IP:</td>
      <td class="itemstyle" align="left"><asp:TextBox id="HostIP" runat="server" Columns="20" /> Current: <asp:CheckBox id="UseCurrent" runat="server"/></td>
    </tr>
    <tr>
      <td class="itemstyle" align="left">Timezone:</td>
      <td class="itemstyle" align="left"><asp:TextBox id="Timezone" runat="server" Columns="3" /></td>
    </tr>
    <tr style="background-color:#ECF9FF;">
      <td class="itemstyle" align="left">Version: </td>
      <td class="itemstyle" align="left"><asp:Label id="Version" runat="server"/></td>
    </tr>
    <tr style="background-color:#0080BF;">
      <td></td>
      <td class="footerstyle" align="center" style="padding: 8px;"><asp:LinkButton runat="server" id="SaveSettings" Text="Save Settings" OnClick="SaveSettingsButton_Click" /></td>
    </tr>
  </table>
<asp:Label id="SettingsError" runat="server" CssClass="Textarea" Visible="false"/>
  <br />
  <h4>Categories</h4>
  <asp:datagrid id="Category" 
  	runat="server" 
	Cellpadding="4"
	onUpdateCommand="UpdateXMLCategory" 
	OnCancelCommand="CancelEditCategory" 
	onEditCommand="SetEditModeCategory" 
	AutoGenerateColumns="False" 
	onDeleteCommand="DelXMLCategory" 
	ShowFooter="True"  
	onItemCommand="DoInsertCategory" 
	BorderWidth="1px" 
	BorderColor="#FFFFFF" 
	BackColor="#FFFFFF" 
	BorderStyle="Solid"
	HeaderStyle-BackColor="#004D81"
	FooterStyle-BackColor="#0080BF"
	AlternatingItemStyle-BackColor="#ecf9ff"
	DataKeyField="item">
    <PagerStyle horizontalalign="Center" forecolor="#8C4510" mode="NumericPages"></PagerStyle>
    <SelectedItemStyle font-bold="True" forecolor="White" backcolor="#738A9C"></SelectedItemStyle>
    <Columns>
    <asp:TemplateColumn
			HeaderText="Category"
			ItemStyle-HorizontalAlign="Left"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Left"
			HeaderStyle-CssClass="headerstyle">
      <itemTemplate> <%# DataBinder.Eval(Container.DataItem,"item") %> </itemTemplate>
      <FooterTemplate>
        <asp:TextBox runat="server" id="Category_Add" Columns="20" />
      </FooterTemplate>
      <EditItemTemplate>
        <asp:Textbox runat="server" Columns="20" id="Category_Edit" Text='<%# DataBinder.Eval(Container.DataItem,"item") %>' />
      </EditItemTemplate>
    </asp:TemplateColumn>
    <asp:EditCommandColumn 
		ButtonType="LinkButton" 
		UpdateText="Update" 
		CancelText="Cancel" 
		EditText="Edit" 
		HeaderText="Edit"
		ItemStyle-HorizontalAlign="Center"
		ItemStyle-CssClass="itemstyle"
		HeaderStyle-HorizontalAlign="Center"
		HeaderStyle-CssClass="headerstyle"> </asp:EditCommandColumn>
    <asp:TemplateColumn 
		HeaderText="Delete"
		ItemStyle-HorizontalAlign="Center"
		ItemStyle-CssClass="itemstyle"
		HeaderStyle-HorizontalAlign="Center"
		HeaderStyle-CssClass="headerstyle" 
		FooterStyle-HorizontalAlign="Center"
		FooterStyle-CssClass="footerstyle">
      <ItemTemplate>
        <asp:LinkButton runat="Server" Text="Delete" CommandName="Delete"/>
      </ItemTemplate>
      <FooterTemplate>
        <asp:LinkButton Text="Add" Runat="Server" CommandName="doAdd" />
      </FooterTemplate>
    </asp:TemplateColumn>
    </Columns>
  </asp:datagrid>
  <asp:Label id="CategoryError" runat="server" CssClass="Textarea" Visible="false"/>
  <br />
  <h4>Blogroll</h4>
  <asp:datagrid id="Blogroll" 
  	runat="server" 
	Cellpadding="4"
	onUpdateCommand="UpdateXMLBlogroll" 
	OnCancelCommand="CancelEditBlogroll" 
	onEditCommand="SetEditModeBlogroll" 
	AutoGenerateColumns="False" 
	onDeleteCommand="DelXMLBlogroll" 
	ShowFooter="True"  
	onItemCommand="DoInsertBlogroll" 
	BorderWidth="1px" 
	BorderColor="#FFFFFF" 
	BackColor="#FFFFFF" 
	BorderStyle="Solid"
	HeaderStyle-BackColor="#004D81"
	FooterStyle-BackColor="#0080BF"
	AlternatingItemStyle-BackColor="#ecf9ff"
	DataKeyField="title">
    <PagerStyle horizontalalign="Center" forecolor="#8C4510" mode="NumericPages"></PagerStyle>
    <SelectedItemStyle font-bold="True" forecolor="White" backcolor="#738A9C"></SelectedItemStyle>
    <Columns>
    <asp:TemplateColumn
			HeaderText="Name"
			ItemStyle-HorizontalAlign="Left"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Left"
			HeaderStyle-CssClass="headerstyle">
      <itemTemplate> <%# DataBinder.Eval(Container.DataItem,"title") %> </itemTemplate>
      <FooterTemplate>
        <asp:TextBox runat="server" id="Title_Add" Columns="20" />
      </FooterTemplate>
      <EditItemTemplate>
        <asp:Textbox runat="server" Columns="20" id="Title_Edit" Text='<%# DataBinder.Eval(Container.DataItem,"title") %>' />
      </EditItemTemplate>
    </asp:TemplateColumn>
    <asp:TemplateColumn
			HeaderText="Link"
			ItemStyle-HorizontalAlign="Left"
			ItemStyle-CssClass="itemstyle"
			HeaderStyle-HorizontalAlign="Left"
			HeaderStyle-CssClass="headerstyle">
      <itemTemplate> <%# DataBinder.Eval(Container.DataItem,"link") %> </itemTemplate>
      <FooterTemplate>
        <asp:TextBox runat="server" id="Link_Add" Columns="40" />
      </FooterTemplate>
      <EditItemTemplate>
        <asp:Textbox runat="server" Columns="20" id="Link_Edit" Text='<%# DataBinder.Eval(Container.DataItem,"link") %>' />
      </EditItemTemplate>
    </asp:TemplateColumn>
    <asp:EditCommandColumn 
		ButtonType="LinkButton" 
		UpdateText="Update" 
		CancelText="Cancel" 
		EditText="Edit" 
		HeaderText="Edit"
		ItemStyle-HorizontalAlign="Center"
		ItemStyle-CssClass="itemstyle"
		HeaderStyle-HorizontalAlign="Center"
		HeaderStyle-CssClass="headerstyle"> </asp:EditCommandColumn>
    <asp:TemplateColumn 
		HeaderText="Delete"
		ItemStyle-HorizontalAlign="Center"
		ItemStyle-CssClass="itemstyle"
		HeaderStyle-HorizontalAlign="Center"
		HeaderStyle-CssClass="headerstyle" 
		FooterStyle-HorizontalAlign="Center"
		FooterStyle-CssClass="footerstyle">
      <ItemTemplate>
        <asp:LinkButton runat="Server" Text="Delete" CommandName="Delete"/>
      </ItemTemplate>
      <FooterTemplate>
        <asp:LinkButton Text="Add" Runat="Server" CommandName="doAdd" />
      </FooterTemplate>
    </asp:TemplateColumn>
    </Columns>
  </asp:datagrid>
  <asp:Label id="BlogrollError" runat="server" CssClass="Textarea" Visible="false"/>
  <br />
  <h4>Backup</h4>
  <span class="Textarea">Create a backup of your blog: </span>
  <asp:Button ID="Backup" Text="Backup" OnClick="BackupButton_Click" runat="server" CssClass="Button"/>
</asp:content>
