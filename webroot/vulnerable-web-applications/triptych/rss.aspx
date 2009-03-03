<%@ Page Language='C#' ContentType='text/xml' ResponseEncoding='iso-8859-1' src="default.cs" Inherits="Feed.Rss"%>
    <!-- generator="TriptychBlog v.9.0" -->
    <rss version="2.0">
      <channel>
        <title><asp:Literal id="Title" runat="server" /> Syndication</title>
        <link><% =Request.Url.ToString().Substring(0, Request.Url.ToString().Length-8) %></link>
        <description>Latest news and updates from <asp:Literal id="Description" runat="server" />.</description>
<asp:Repeater id="RSS" runat="server">
  <ItemTemplate>
        <item>
		
          <title><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleName")) %></title>
		  
          <description><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleContent")) %></description>
		  
          <link><% =Request.Url.ToString().Substring(0, Request.Url.ToString().Length-8) %>Comments.aspx?ArticleId=<%# DataBinder.Eval(Container.DataItem, "ArticleID") %>&amp;ArticleName=<%# Feed.Format.ForURL(DataBinder.Eval(Container.DataItem, "ArticleName")) %></link>
		  
          <author><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleUserName")) %></author>
		  
          <pubDate><%# DataBinder.Eval(Container.DataItem, "ArticleDate") %></pubDate>

	  <guid><% =Request.Url.ToString().Substring(0, Request.Url.ToString().Length-8) %>Comments.aspx?ArticleId=<%# DataBinder.Eval(Container.DataItem, "ArticleID") %>&amp;ArticleName=<%# Feed.Format.ForURL(DataBinder.Eval(Container.DataItem, "ArticleName")) %></guid>
		  
        </item>
  </ItemTemplate>
</asp:Repeater>
   </channel>
    </rss>  