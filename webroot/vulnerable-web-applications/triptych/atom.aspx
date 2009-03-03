<%@ Page Language='C#' ContentType='text/xml' ResponseEncoding='iso-8859-1' src="default.cs" Inherits="Feed.Atom"%>
<feed xmlns="http://www.w3.org/2005/Atom">
        <title><asp:Literal id="Title" runat="server" /> Syndication</title>
        <subtitle>Latest news and updates from <asp:Literal id="Description" runat="server" />.</subtitle>
        <link rel="self" href="<% =Request.Url.ToString().Substring(0, Request.Url.ToString().Length) %>"/>
        <link rel="alternate" type="text/html" href="<% =Request.Url.ToString().Substring(0, Request.Url.ToString().Length-9) %>" title="<asp:Literal id='Title2' runat='server' />" />
        <updated><% =DateTime.Now.ToString( "G" )%><asp:Literal id="Timezone" runat="server" /></updated>
        <author>
		<name><asp:Literal id="Title3" runat="server" /></name>
        </author>
	<generator>TriptychBlog</generator>
	<id><% =Request.Url.ToString().Substring(0, Request.Url.ToString().Length) %></id>
<asp:Repeater id="ATOM" runat="server">
  <ItemTemplate>
        <entry>
        	<title><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleName")) %></title>
        	<link rel="alternate" type="text/html" href="http://triptychstudios.net/TriptychBlog/Comments.aspx?ArticleId=<%# DataBinder.Eval(Container.DataItem, "ArticleID") %>&amp;ArticleName=<%# Feed.Format.ForURL(DataBinder.Eval(Container.DataItem, "ArticleName")) %>" title="<%# Feed.Format.ForURL(DataBinder.Eval(Container.DataItem, "ArticleName")) %>" />
        	<author>
			<name><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleUserName")) %></name>
		</author>
        	<updated><%# DataBinder.Eval(Container.DataItem, "ArticleDate") %></updated>
        	<id><% =Request.Url.ToString().Substring(0, Request.Url.ToString().Length-9) %>Comments.aspx?ArticleId=<%# DataBinder.Eval(Container.DataItem, "ArticleID") %>&amp;ArticleName=<%# Feed.Format.ForURL(DataBinder.Eval(Container.DataItem, "ArticleName")) %></id>
        	<summary><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleContent")) %></summary>
	</entry>
  </ItemTemplate>
</asp:Repeater>

</feed>  
