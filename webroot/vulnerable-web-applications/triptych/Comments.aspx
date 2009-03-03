<%@ Page Language='C#' ContentType='text/html' ResponseEncoding='iso-8859-1' src="default.cs" Inherits="Comments"  masterpagefile="TriptychBlog.master"%>

<asp:content id="CommentsHead" contentplaceholderid="ContentHead" runat="server">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>
  <asp:Literal Id="Title" runat="server" />
  ::
  <asp:Literal Id="Description" runat="server" />
  </title>
  <link href="styles.css" rel="stylesheet" type="text/css" />
  <link rel="Shortcut Icon" href="./images/favicon.ico" type="image/x-icon" />
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.aspx" />
  <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="atom.aspx" />
  <meta name="keywords" content="TriptychStudios,TriptychBlog,Triptych,Asp.net,Blogging Engine,Open-Source,Open Source,Access,Comments,Admin,Panel,ASP.net 2.0" />
  <meta name="description" content="Open Source ASP.net Blogging Engine, TriptychBlog" />
  </head>
</asp:content>
<asp:content id="Comments" contentplaceholderid="Content" runat="server">
  <asp:Repeater Id="ArticleRepeater" runat="server">
    <itemtemplate>
      <div class="Title">
        <h1><img src="images/title_logo.png" alt="" border="0" style="vertical-align: text-bottom;"/><%#DataBinder.Eval(Container.DataItem, "ArticleName")%></h1>
      </div>
      <div class="ArticleInfo">By: <a class="ArticleInfo" href="#"><%#DataBinder.Eval(Container.DataItem, "ArticleUserName")%></a> | <a class="ArticleInfo" href="#">Comments [<%#DataBinder.Eval(Container.DataItem, "ArticleComments")%>]</a> | Category: <a class="ArticleInfo" href="?Category=<%#DataBinder.Eval(Container.DataItem, "Category")%>"><%#DataBinder.Eval(Container.DataItem, "Category")%></a> | <%# (DataBinder.Eval(Container.DataItem, "ArticleDate").ToString()).Substring(0,(DataBinder.Eval(Container.DataItem, "ArticleDate").ToString()).Length-15) %></div>
      <div class="ArticleContent"><%#DataBinder.Eval(Container.DataItem, "ArticleContent")%></div>
    </ItemTemplate>
  </asp:Repeater>
  <asp:Panel Id="Respond" runat="server">
    <div class="Title">
      <h2>
        <asp:Label ID="lblArticleComments" Runat="Server" />
        Response(s) to
        <asp:Label ID="lblArticleName" Runat="Server" />
      </h2>
    </div>
    </asp:Panel>
  <asp:Repeater Id="CommentRepeater" runat="server">
    <itemtemplate>
      <div class="CommentBox">
	  	<div class="CommentNumber"><%#DataBinder.Eval(Container.DataItem, "CommentNumber")%></div>
        <div class="CommentUser"><%#DataBinder.Eval(Container.DataItem, "CommentUserName")%></div>
        <div class="CommentInfo"><%#DataBinder.Eval(Container.DataItem, "CommentDate")%></div>
        <br />
        <div class="CommentContent"><%#DataBinder.Eval(Container.DataItem, "CommentContent")%></div>
      </div>
    </ItemTemplate>
  </asp:Repeater>
  <asp:Panel Id="Open" runat="server">
    <div class="Title">
      <h3>Leave a Reply:</h3>
    </div>
    <div align="center">
      <asp:TextBox ID="CommentContent" runat="server" TextMode="MultiLine" Rows="6" Font-Name="Verdana" Columns="50" Font-Size="8" Width="490px"/>
      <br />
      <asp:Button ID="Submit_Comment" runat="server" Text="Submit Comment" CssClass="Button" OnClick="subcomButton_Click"/>
    </div>
    </asp:Panel>
  <asp:Panel Id="Protected" runat="server">
    <div class="CommentBox">
      <div class="CommentUser">Comments Protected</div>
      <br />
      <div class="CommentContent">You do not have the neccesary permissions to comment on this article.</div>
    </div>
    </asp:Panel>
  <asp:Panel Id="Locked" runat="server">
    <div class="CommentBox">
      <div class="CommentUser">Comments Locked</div>
      <br />
      <div class="CommentContent">No comments may be added to this article.</div>
    </div>
    </asp:Panel>
</asp:content>
