<%@ Page Language='C#' masterpagefile="TriptychBlog.master" ResponseEncoding='iso-8859-1' src="default.cs" Inherits="Default" ContentType="text/html"%>

<asp:content id="BlogHead" contentplaceholderid="ContentHead" runat="server">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title><asp:Literal Id="Title" runat="server" /> :: <asp:Literal Id="Description" runat="server" /></title>
  <link href="styles.css" rel="stylesheet" type="text/css" />
  <link rel="Shortcut Icon" href="./images/favicon.ico" type="image/x-icon" />
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.aspx" />
  <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="atom.aspx" />
  </head>
</asp:content>
<asp:content id="Blog" contentplaceholderid="Content" runat="server">
  <asp:Repeater ID="Content" runat="server">
    <ItemTemplate>
	  <div class="Title"><h1><img src="images/title_logo.png" alt="" border="0" style="vertical-align: text-bottom;"/><a class="Title" href="./Comments.aspx?ArticleId=<%#DataBinder.Eval(Container.DataItem, "ArticleID")%>&amp;ArticleName=<%#DataBinder.Eval(Container.DataItem, "ArticleName")%>"><%#DataBinder.Eval(Container.DataItem, "ArticleName")%></a></h1></div>
	  <div class="ArticleInfo">By: <a class="ArticleInfo" href="#"><%#DataBinder.Eval(Container.DataItem, "ArticleUserName")%></a> | <a class="ArticleInfo" href="./Comments.aspx?ArticleId=<%#DataBinder.Eval(Container.DataItem, "ArticleID")%>&amp;ArticleName=<%#DataBinder.Eval(Container.DataItem, "ArticleName")%>">Comments [<%#DataBinder.Eval(Container.DataItem, "ArticleComments")%>]</a> | Category: <a class="ArticleInfo" href="?Category=<%#DataBinder.Eval(Container.DataItem, "Category")%>"><%#DataBinder.Eval(Container.DataItem, "Category")%></a> | <%# (DataBinder.Eval(Container.DataItem, "ArticleDate").ToString()).Substring(0,(DataBinder.Eval(Container.DataItem, "ArticleDate").ToString()).Length-15) %></div>
	  <div class="ArticleContent"><%#DataBinder.Eval(Container.DataItem, "ArticleContent")%></div>
    </ItemTemplate>
  </asp:Repeater>
</asp:content>
