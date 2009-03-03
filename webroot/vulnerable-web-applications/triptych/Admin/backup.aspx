<%@ Page Language='C#' ContentType='text/xml' ResponseEncoding='iso-8859-1' src="admin.cs" Inherits="Feed.Backup"%><?xml version="1.0" encoding="utf-8" ?>
	<backup>
    	<title><asp:Literal id="Title" runat="server" /></title>
    	<created><% =DateTime.Now.ToString( "G" )%> <asp:Literal id="Timezone" runat="server" /></created>
    	<author><asp:Literal id="UserName" runat="server" /></author>
		<generator><asp:Literal id="Generator" runat="server" /></generator>
	<asp:Repeater id="Article" runat="server">
	<HeaderTemplate>
		<content>
			<article>
	</HeaderTemplate>

	<ItemTemplate>
				<item>
					<articledate><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleDate")) %></articledate>
					<articlename><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleName")) %></articlename>
					<articlecontent><![CDATA[<%# DataBinder.Eval(Container.DataItem, "ArticleContent") %>]]></articlecontent>
					<articleusername><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleUserName")) %></articleusername>
					<articleid><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleId")) %></articleid>
					<hidden><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "Hidden")) %></hidden>
					<articlecomments><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "ArticleComments")) %></articlecomments>
					<lastcomment><![CDATA[<%# DataBinder.Eval(Container.DataItem, "LastComment") %>]]></lastcomment>
					<category><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "Category")) %></category>
					<commentprotection><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "CommentProtection")) %></commentprotection>
				</item>
	</ItemTemplate>

  	<FooterTemplate>
			</article>
	</FooterTemplate>
	</asp:Repeater>
	
	<asp:Repeater id="Comment" runat="server">
	<HeaderTemplate>
			<comment>
	</HeaderTemplate>

	<ItemTemplate>
				<item>
					<commentusername><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "CommentUserName")) %></commentusername>
					<commentdate><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "CommentDate")) %></commentdate>
					<commentcontent><![CDATA[<%# DataBinder.Eval(Container.DataItem, "CommentContent") %>]]></commentcontent>
					<commentid><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "CommentNumber")) %></commentid>
					<commentnumber><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "CommentNumber")) %></commentnumber>
					<commentname><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "CommentName")) %></commentname>
					<ipaddress><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "IPAddress")) %></ipaddress>
					<browsertype><%# Feed.Format.ForXML(DataBinder.Eval(Container.DataItem, "BrowserType")) %></browsertype>
				</item>
	</ItemTemplate>

  	<FooterTemplate>
			</comment>
	</FooterTemplate>
	</asp:Repeater>
	</content>
	<config>
	<asp:Repeater id="Blogroll" runat="server">
	<HeaderTemplate>
		
	</HeaderTemplate>
	
	<ItemTemplate>
				<blogroll>
					<title><%# ((System.Xml.XmlNode)Container.DataItem)["title"].InnerText %></title>
					<link><%# ((System.Xml.XmlNode)Container.DataItem)["link"].InnerText %></link>
				</blogroll>
	</ItemTemplate>			
	</asp:Repeater>
	
	<asp:Repeater id="Category" runat="server">
	<ItemTemplate>
				<category>
					<item><%# ((System.Xml.XmlNode)Container.DataItem)["item"].InnerText %></item>
				</category>
	</ItemTemplate>			

	</asp:Repeater>
	
	<asp:Repeater id="Settings" runat="server">
	<HeaderTemplate>
			<settings>
	</HeaderTemplate>

	<ItemTemplate>
				<title><%# ((System.Xml.XmlNode)Container.DataItem)["title"].InnerText %></title>
				<description><%# ((System.Xml.XmlNode)Container.DataItem)["description"].InnerText %></description>
				<language><%# ((System.Xml.XmlNode)Container.DataItem)["language"].InnerText %></language>
				<display><%# ((System.Xml.XmlNode)Container.DataItem)["display"].InnerText %></display>
				<recentdisplay><%# ((System.Xml.XmlNode)Container.DataItem)["recentdisplay"].InnerText %></recentdisplay>
				<hostip><%# ((System.Xml.XmlNode)Container.DataItem)["hostip"].InnerText %></hostip>
				<timezone><%# ((System.Xml.XmlNode)Container.DataItem)["timezone"].InnerText %></timezone>
	</ItemTemplate>	
	
	<FooterTemplate>
			</settings>
	</FooterTemplate>	
	</asp:Repeater>
	
	<asp:Repeater id="Theme" runat="server" visible="false">
	<ItemTemplate>
				<theme>
					<title><%# ((System.Xml.XmlNode)Container.DataItem)["title"].InnerText %></title>
					<source><%# ((System.Xml.XmlNode)Container.DataItem)["source"].InnerText %></source>
					<selected><%# ((System.Xml.XmlNode)Container.DataItem)["selected"].InnerText %></selected>
				</theme>
	</ItemTemplate>
	</asp:Repeater>
		</config>
	</backup>
