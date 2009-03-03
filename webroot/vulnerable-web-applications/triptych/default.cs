/*////////////////////////////////////////////////////////////////////
 *                                                                  *
 *                        TRIPTYCHBLOG v.9.0.1                        *
 *       Copyright 2007 TriptychStudios. All Rights Reservered.     *
 *                                                                  *
 * Filename: Default.cs                                             *
 * Modified: June 15th, 2007                                        *
 * Author: TriptychStudios                                          *
 * License: GNU General Public License (GPL) 2.0                    *
 *                                                                  *
 * /////////////////////////////////////////////////////////////////*/

/*////////////////////////////////////////////////////////////////////
 * This program is free software; you can redistribute it and/or     *
 * modify it under the terms of the GNU General Public License       *
 * as published by the Free Software Foundation; either version 2    *
 * of the License, or (at your option) any later version.            *
 *                                                                   *
 * This program is distributed in the hope that it will be useful,   *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of    *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the     *
 * GNU General Public License for more details.                      *
 *                                                                   *
 * You should have received a copy of the GNU General Public License *
 * along with this program; if not, write to the Free Software       *
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA     *
 * 02110-1301, USA.                                                  *
 * /////////////////////////////////////////////////////////////////*/


using System;
using System.Collections;
using System.ComponentModel;
using System.Data;
using System.Data.OleDb;
using System.Drawing;
using System.Web;
using System.Web.SessionState;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.HtmlControls;
using System.Web.Security;
using System.Web.Mail;
using System.IO;
using System.Drawing;
using System.Drawing.Imaging;
using System.Xml;
using System.Text.RegularExpressions;
using System.Net;
using System.Collections.Generic;
using System.Text;

public class TriptychBlogSettings
{
    public string strTitle;
    public string strDescription;
    public string strLanguage;
    public string strDisplay;
    public string strRecentDisplay;
    public string strHostIP;
    public string strTimezone;
    public string strVersion;
    string strFilename = "./Config.xml";

    public TriptychBlogSettings()
    {
        XmlTextReader srXML = new XmlTextReader(HttpContext.Current.Server.MapPath(strFilename));
        DataSet dsXML = new DataSet();

        try
        {
            dsXML.ReadXml(srXML);
            srXML.Close();
            if (dsXML.Tables["settings"] == null)
            {
                Config.Settings();
            }
                
            GetSettings();
        }
        catch
        {
            srXML.Close();
            Config.New();
            GetSettings();
        }
    }

    public void GetSettings()
    {
        XmlDocument xmlConfig = new XmlDocument();
        xmlConfig.Load(HttpContext.Current.Server.MapPath(strFilename));

        XmlNodeList xmlCategory = xmlConfig.SelectNodes("config/settings");

        foreach (XmlNode Item in xmlCategory)
        {
            strTitle = Item["title"].InnerText.ToString();
            strDescription = Item["description"].InnerText.ToString();
            strLanguage = Item["language"].InnerText.ToString();
            strDisplay = Item["display"].InnerText.ToString();
            strRecentDisplay = Item["recentdisplay"].InnerText.ToString();
            strHostIP = Item["hostip"].InnerText.ToString();
            strTimezone = Item["timezone"].InnerText.ToString();
            strVersion = Item["version"].InnerText.ToString();
        }
    }

    public string Title()
    {
        return strTitle;
    }

    public string Description()
    {
        return strDescription;
    }

    public string Language()
    {
        return strLanguage;
    }

    public string Display()
    {
        return strDisplay;
    }

    public string RecentDisplay()
    {
        return strRecentDisplay;
    }

    public string HostIP()
    {
        return strHostIP;
    }

    public string Timezone()
    {
        return strTimezone;
    }

    public string Version()
    {
        return strVersion;
    }
}

public class Config
{
    public static string strFilename = "./Config.xml";

    public static void New()
    {
        //Create new config.xml adding blogroll, category and settings
        XmlTextWriter swXML = new XmlTextWriter(HttpContext.Current.Server.MapPath(strFilename), Encoding.UTF8);
        DataSet dsXML = new DataSet("config");

        DataTable dtBlogroll = new DataTable("blogroll");
        DataRow drBlogroll;

        dtBlogroll.Columns.Add(new DataColumn("title"));
        dtBlogroll.Columns.Add(new DataColumn("link"));

        drBlogroll = dtBlogroll.NewRow();
        drBlogroll[0] = "Admin Panel";
        drBlogroll[1] = "./Admin";

        dtBlogroll.Rows.Add(drBlogroll);

        dsXML.Tables.Add(dtBlogroll);

        DataTable dtCategory = new DataTable("category");
        DataRow drCategory;

        dtCategory.Columns.Add(new DataColumn("item"));

        drCategory = dtCategory.NewRow();
        drCategory[0] = "General";

        dtCategory.Rows.Add(drCategory);

        dsXML.Tables.Add(dtCategory);

        DataTable dtSettings = new DataTable("settings");
        DataRow drSettings;

        dtSettings.Columns.Add(new DataColumn("title"));
        dtSettings.Columns.Add(new DataColumn("description"));
        dtSettings.Columns.Add(new DataColumn("language"));
        dtSettings.Columns.Add(new DataColumn("display"));
        dtSettings.Columns.Add(new DataColumn("recentdisplay"));
        dtSettings.Columns.Add(new DataColumn("hostip"));
        dtSettings.Columns.Add(new DataColumn("timezone"));
        dtSettings.Columns.Add(new DataColumn("version"));

        drSettings = dtSettings.NewRow();
        drSettings[0] = "Blog Title";
        drSettings[1] = "Blog Description";
        drSettings[2] = "English";
        drSettings[3] = "10";
        drSettings[4] = "5";
        drSettings[5] = "0.0.0.0";
        drSettings[6] = "GMT";
        drSettings[7] = ".9.0.1";

        dtSettings.Rows.Add(drSettings);
        dsXML.Tables.Add(dtSettings);

        swXML.Formatting = Formatting.Indented;
        swXML.Indentation = 4;
        swXML.WriteStartDocument();
        dsXML.WriteXml(swXML);
        swXML.Close();
    }

    public static void Settings()
    {
        //Add Settings info to already existing file
        XmlTextReader srXML = new XmlTextReader(HttpContext.Current.Server.MapPath(strFilename));

        DataSet dsSettings = new DataSet("config");
        DataTable dtSettings = new DataTable("settings");
        DataRow drSettings;

        dsSettings.ReadXml(srXML);
        srXML.Close();

        XmlTextWriter swXML = new XmlTextWriter(HttpContext.Current.Server.MapPath(strFilename), Encoding.UTF8);

        dtSettings.Columns.Add(new DataColumn("title"));
        dtSettings.Columns.Add(new DataColumn("description"));
        dtSettings.Columns.Add(new DataColumn("language"));
        dtSettings.Columns.Add(new DataColumn("display"));
        dtSettings.Columns.Add(new DataColumn("recentdisplay"));
        dtSettings.Columns.Add(new DataColumn("hostip"));
        dtSettings.Columns.Add(new DataColumn("timezone"));
        dtSettings.Columns.Add(new DataColumn("version"));

        drSettings = dtSettings.NewRow();
        drSettings[0] = "Blog Title";
        drSettings[1] = "Blog Description";
        drSettings[2] = "English";
        drSettings[3] = "10";
        drSettings[4] = "5";
        drSettings[5] = "0.0.0.0";
        drSettings[6] = "GMT";
        drSettings[7] = ".9.0.1";

        dtSettings.Rows.Add(drSettings);

        dsSettings.Tables.Add(dtSettings);

        swXML.Formatting = Formatting.Indented;
        swXML.Indentation = 4;
        swXML.WriteStartDocument();
        dsSettings.WriteXml(swXML);
        swXML.Close();
    }

    public static void Category()
    {
        //Add Category info to already existing file
        XmlTextReader srXML = new XmlTextReader(HttpContext.Current.Server.MapPath(strFilename));

        DataSet dsCategory = new DataSet("config");
        DataTable dtCategory = new DataTable("category");
        DataRow drCategory;

        dsCategory.ReadXml(srXML);
        srXML.Close();

        XmlTextWriter swXML = new XmlTextWriter(HttpContext.Current.Server.MapPath(strFilename), Encoding.UTF8);

        dtCategory.Columns.Add(new DataColumn("item"));

        drCategory = dtCategory.NewRow();
        drCategory[0] = "General";

        dtCategory.Rows.Add(drCategory);

        dsCategory.Tables.Add(dtCategory);

        swXML.Formatting = Formatting.Indented;
        swXML.Indentation = 4;
        swXML.WriteStartDocument();
        dsCategory.WriteXml(swXML);
        swXML.Close();
    }

    public static void Blogroll()
    {
        //Add Blogroll info to already existing file
        XmlTextReader srXML = new XmlTextReader(HttpContext.Current.Server.MapPath(strFilename));

        DataSet dsBlogroll = new DataSet("config");
        DataTable dtBlogroll = new DataTable("blogroll");
        DataRow drBlogroll;

        dsBlogroll.ReadXml(srXML);
        srXML.Close();

        XmlTextWriter swXML = new XmlTextWriter(HttpContext.Current.Server.MapPath(strFilename), Encoding.UTF8);

        dtBlogroll.Columns.Add(new DataColumn("title"));
        dtBlogroll.Columns.Add(new DataColumn("link"));

        drBlogroll = dtBlogroll.NewRow();
        drBlogroll[0] = "Admin Panel";
        drBlogroll[1] = "./Admin";

        dtBlogroll.Rows.Add(drBlogroll);

        dsBlogroll.Tables.Add(dtBlogroll);

        swXML.Formatting = Formatting.Indented;
        swXML.Indentation = 4;
        swXML.WriteStartDocument();
        dsBlogroll.WriteXml(swXML);
        swXML.Close();
    }
}

public class Master : System.Web.UI.MasterPage
{
	protected System.Web.UI.WebControls.Repeater Latest;
	protected System.Web.UI.WebControls.Repeater Blogroll;
	protected System.Web.UI.WebControls.Repeater Category;
    protected System.Web.UI.WebControls.Repeater Archive;
    protected System.Web.UI.WebControls.Literal Title;
    protected System.Web.UI.WebControls.Literal Description;
    protected System.Web.UI.WebControls.Literal Version;
	public string strCount;

	protected void Page_Load(object sender, System.EventArgs e) 
	{
        OleDbConnection conNewsData;
	    OleDbCommand cmdSelectDB;
	    OleDbDataReader dtrArticleData;
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        Description.Text = TBSettings.Description();
        Version.Text = TBSettings.Version();
        
    			
	    conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("./NewsData.mdb") );
	    conNewsData.Open();
	    cmdSelectDB = new OleDbCommand( "Select TOP " + TBSettings.RecentDisplay() + " * From ArticleData WHERE Hidden = 'No' ORDER BY ArticleId DESC", conNewsData );
	    dtrArticleData = cmdSelectDB.ExecuteReader();
	    Latest.DataSource = dtrArticleData;  
	    Latest.DataBind(); 
	    conNewsData.Close();

        XmlDocument xmlConfig = new XmlDocument();
        xmlConfig.Load(Server.MapPath("./Config.xml"));

        XmlNodeList xmlBlogroll = xmlConfig.SelectNodes("config/blogroll");
        Blogroll.DataSource = xmlBlogroll;
        Blogroll.DataBind();

        XmlNodeList xmlCategory = xmlConfig.SelectNodes("config/category");
        Category.DataSource = xmlCategory;
        Category.DataBind();

        DateTime Timestamp = DateTime.Now;
        string DateNow = Timestamp.ToString("G");

        int intMaxArticle = 0;
        string MaxArticle = "SELECT COUNT(ArticleID) from ArticleData WHERE Hidden = 'No'";
        OleDbCommand cmdArticleNumber = new OleDbCommand(MaxArticle, conNewsData);
        conNewsData.Open();
        Object objMax = cmdArticleNumber.ExecuteScalar();
        if (objMax != DBNull.Value)
        {
            intMaxArticle = Convert.ToInt32(objMax);
        }

        conNewsData.Close();

        conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("./NewsData.mdb"));
        conNewsData.Open();
        cmdSelectDB = new OleDbCommand("Select ArticleDate From ArticleData WHERE Hidden = 'No'", conNewsData);
        dtrArticleData = cmdSelectDB.ExecuteReader();

        string[] strPublishDate = new string[intMaxArticle];
        DateTime[] dtPublishDate = new DateTime[intMaxArticle];
        int intStart = 0;

        while (dtrArticleData.Read())
        {
            strPublishDate[intStart] = dtrArticleData.GetString(0);
            intStart++;
        }

        dtrArticleData.Close();
        conNewsData.Close();

        int intLast = 0;
        string strLast = "";
        int intEntries;
        ArrayList alPublishDate = new ArrayList();

        for (intEntries = 0; intEntries < intMaxArticle; intEntries++)
        {
            strPublishDate[intEntries] = strPublishDate[intEntries].Replace(" " + TBSettings.Timezone(), "");
            dtPublishDate[intEntries] = (DateTime)(TypeDescriptor.GetConverter(new DateTime()).ConvertFrom(strPublishDate[intEntries]));

            strPublishDate[intEntries] = dtPublishDate[intEntries].ToString("MMMM yyyy");
        }

        for (intEntries = --intEntries; intEntries >= 0; intEntries--)
        {
            if (intEntries == 0)
            {
                strLast = "";
            }
            else
            {
                strLast = strPublishDate[intEntries - 1];
            }


            if (strLast != strPublishDate[intEntries])
            {
                intLast++;
                alPublishDate.Add(strPublishDate[intEntries]);// + " [" + intLast + "]");
                intLast = 0;
            }
            else
            {
                intLast++;
            }
        }

        Archive.DataSource = alPublishDate;
        Archive.DataBind();

        int Visitor;
        DateNow = DateNow + " " + TBSettings.Timezone();
        string IP = Request.UserHostAddress.ToString();
        string Browser = Request.Browser.Browser;
        string BrowserVersion = Request.Browser.Version;
        string UserAgent = Request.UserAgent.ToString();
        string Referrer = "";
        if (Request.UrlReferrer != null)
        {
            Referrer = Request.UrlReferrer.ToString();
        }

        /*WebRequest request = WebRequest.Create(Request.Url.ToString());
        HttpWebResponse response = (HttpWebResponse)request.GetResponse();
        Stream dataStream = response.GetResponseStream();
        StreamReader reader = new StreamReader(dataStream);
        string strPage = reader.ReadToEnd();

        string regex = @"(?<=<title.*>)([\s\S]*)(?=</title>)";
        Regex ex = new Regex(regex, RegexOptions.IgnoreCase);
        string Page = ex.Match(strPage).Value.Trim();*/

        string Page = Request.Url.ToString();
        string Spider = Request.Browser.Crawler.ToString();
        string OS = Request.Browser.Platform.ToString();

        if (IP != TBSettings.HostIP())
        {
            string MaxVisitor = "SELECT MAX(Visitor) from TrafficData";
            OleDbCommand cmdVisitorNumber = new OleDbCommand(MaxVisitor, conNewsData);
            conNewsData.Open();
            objMax = cmdVisitorNumber.ExecuteScalar();
            if (objMax != DBNull.Value)
            {
                Visitor = Convert.ToInt32(objMax) + 1;
            }
            else
            {
                Visitor = 1;
            }

            conNewsData.Close();

            string strInsert = "Insert Into TrafficData (Visitor, StatsDate, IP, Browser, BrowserVersion, UserAgent, Referrer, Page, Spider, OS) Values (@Visitor, @StatsDate, @IP, @Browser, @BrowserVersion, @UserAgent, @Referrer, @Page, @Spider, @OS)";
            OleDbCommand cmdInsert = new OleDbCommand(strInsert, conNewsData);
            cmdInsert.Parameters.Add("@Visitor", Visitor);
            cmdInsert.Parameters.Add("@StatsDate", DateNow);
            cmdInsert.Parameters.Add("@IP", IP);
            cmdInsert.Parameters.Add("@Browser", Browser);
            cmdInsert.Parameters.Add("@BrowserVersion", BrowserVersion);
            cmdInsert.Parameters.Add("@UserAgent", UserAgent);
            cmdInsert.Parameters.Add("@Referrer", Referrer);
            cmdInsert.Parameters.Add("@Page", Page);
            cmdInsert.Parameters.Add("@Spider", Spider);
            cmdInsert.Parameters.Add("@OS", OS);
            conNewsData.Open();
            cmdInsert.ExecuteNonQuery();
            conNewsData.Close();
        }
	}
}

public class Default : System.Web.UI.Page
{
    protected System.Web.UI.WebControls.Repeater Content;
    protected System.Web.UI.WebControls.Label UserPanel;
    protected System.Web.UI.WebControls.Label hdnArticleId;
    protected System.Web.UI.WebControls.Literal Title;
    protected System.Web.UI.WebControls.Literal Description;

	protected void Page_Load(object sender, System.EventArgs e) 
	{
		OleDbConnection conNewsData;
		OleDbCommand cmdSelectDB;
		OleDbDataReader dtrArticleData;
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
		
		conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("./NewsData.mdb") );
		conNewsData.Open();

        string strDefault = "SELECT * FROM ArticleData WHERE Hidden = 'No' ";

        if (Request.QueryString.Get("Month") == null && Request.QueryString.Get("Year") == null && Request.QueryString.Get("Category") == null)
        {
            Description.Text = TBSettings.Description();
        }

        if (Request.QueryString.Get("Category") != null)
        {
            strDefault += "AND Category = @Category ";
            Description.Text = Request.QueryString.Get("Category") + " ";
        }

        if (Request.QueryString.Get("Month") != null)
        {
            strDefault += "AND ArticleDate LIKE @Month ";
            Description.Text += ToMonthStr(Convert.ToInt32(Request.QueryString.Get("Month"))) + " ";
        }

        if (Request.QueryString.Get("Year") != null)
        {
            strDefault += "AND ArticleDate LIKE @Year ";
            Description.Text += Request.QueryString.Get("Year");
        }

        strDefault += "ORDER BY ArticleId DESC";

        cmdSelectDB = new OleDbCommand(strDefault, conNewsData);

        if (Request.QueryString.Get("Category") != null)
        {
            cmdSelectDB.Parameters.Add(new OleDbParameter("@Category", Request.QueryString.Get("Category")));
        }

        if (Request.QueryString.Get("Month") != null)
        {
            cmdSelectDB.Parameters.Add(new OleDbParameter("@Month", Request.QueryString.Get("Month") + "/%"));
        }

        if (Request.QueryString.Get("Year") != null)
        {
            cmdSelectDB.Parameters.Add(new OleDbParameter("@Year", "%/" + Request.QueryString.Get("Year") + "%"));
        }

        dtrArticleData = cmdSelectDB.ExecuteReader();
        Content.DataSource = dtrArticleData;
        Content.DataBind();
		conNewsData.Close();
	}

    public static int ToMonth(string strMonth)
    {
        switch (strMonth)
        {
            case "January":
                return 1;
                break;
            case "February":
                return 2;
                break;
            case "March":
                return 3;
                break;
            case "April":
                return 4;
                break;
            case "May":
                return 5;
                break;
            case "June":
                return 6;
                break;
            case "July":
                return 7;
                break;
            case "August":
                return 8;
                break;
            case "September":
                return 9;
                break;
            case "October":
                return 10;
                break;
            case "November":
                return 11;
                break;
            case "December":
                return 12;
                break;
            default:
                return 0;
                break;
        }
    }

    public static string ToMonthStr(int intMonth)
    {
        switch (intMonth)
        {
            case 1:
                return "January";
                break;
            case 2:
                return "February";
                break;
            case 3:
                return "March";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "May";
                break;
            case 6:
                return "June";
                break;
            case 7:
                return "July";
                break;
            case 8:
                return "August";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "October";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "December";
                break;
            default:
                return "Unknown";
                break;
        }
    }
}

public class Comments : System.Web.UI.Page
{
    public int CommentNumber = 0;
    protected System.Web.UI.WebControls.Label UserPanel;
    protected System.Web.UI.WebControls.Repeater CommentRepeater;
    protected System.Web.UI.WebControls.Repeater ArticleRepeater;
    protected System.Web.UI.WebControls.TextBox CommentContent;
    protected System.Web.UI.WebControls.TextBox UserName;
    protected System.Web.UI.WebControls.Button Submit_Comment;
    protected System.Web.UI.WebControls.Panel Open;
    protected System.Web.UI.WebControls.Panel Locked;
    protected System.Web.UI.WebControls.Panel Protected;
    protected System.Web.UI.WebControls.Panel Respond;
    protected System.Web.UI.WebControls.Label lblArticleComments;
    protected System.Web.UI.WebControls.Label lblArticleName;
    protected System.Web.UI.WebControls.Literal Title;
    protected System.Web.UI.WebControls.Literal Description;

    protected void Page_Load(object sender, System.EventArgs e) 
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        Description.Text = Request.QueryString.Get("ArticleName");
        
        if ( !IsPostBack ) 
        {
		    BindData();
 	    }	
    }
					 			
	private void BindData() 
    {
	    DataSet NewsDS = new DataSet();   
			
	    OleDbConnection conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("./NewsData.mdb") );
	    OleDbCommand cmdSelectArticleDB = new OleDbCommand( "Select * FROM ArticleData WHERE ArticleId= @ArticleId", conNewsData );
	    OleDbCommand cmdSelectCommentDB = new OleDbCommand( "Select * FROM CommentData WHERE CommentId= @CommentId ORDER BY CommentNumber ASC", conNewsData );
		
	    cmdSelectArticleDB.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("ArticleId")));
	    cmdSelectCommentDB.Parameters.Add(new OleDbParameter("@CommentId", Request.QueryString.Get("ArticleId")));
		
	    OleDbDataAdapter adpSelectDB = new OleDbDataAdapter();
		
	    adpSelectDB.SelectCommand = cmdSelectArticleDB;
	    adpSelectDB.Fill( NewsDS, "ArticleData" );

	    adpSelectDB.SelectCommand = cmdSelectCommentDB;
	    adpSelectDB.Fill( NewsDS, "CommentData" );
	
	    NewsDS.Relations.Add( "ArticleComments", NewsDS.Tables["ArticleData"].Columns["ArticleName"], NewsDS.Tables["CommentData"].Columns["CommentName"] );
 			
	    ArticleRepeater.DataSource = NewsDS;
	    ArticleRepeater.DataMember = "ArticleData";
	    ArticleRepeater.DataBind();
		
	    CommentRepeater.DataSource = NewsDS;
	    CommentRepeater.DataMember = "CommentData";
	    CommentRepeater.DataBind();
		
	    string comProtection;
	    string CommentProtection = "SELECT CommentProtection from ArticleData WHERE ArticleId = @ArticleId";
	    OleDbCommand cmdCommentProtection = new OleDbCommand( CommentProtection, conNewsData );
	    cmdCommentProtection.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("ArticleId")));
	    conNewsData.Open();
	    Object objProtection = cmdCommentProtection.ExecuteScalar();
	    comProtection = objProtection.ToString();
	    conNewsData.Close();
		
        if ( comProtection == "Open")
	    {
	        Open.Visible = true;
	        Locked.Visible = false;
	        Protected.Visible = false;
	        Respond.Visible = true;
	    }
	
        else if ( comProtection == "Locked")
	    {
	        Open.Visible = false;
	        Locked.Visible = true;
	        Protected.Visible = false;
	        Respond.Visible = false;
	    }
		
        else if ( comProtection == "Protected")
	    {
	        Open.Visible = false;
	        Locked.Visible = false;
	        Protected.Visible = true;
	        Respond.Visible = false;
	    }
		
	    string comArticleName;
	    string ArticleName = "SELECT ArticleName from ArticleData WHERE ArticleId = @ArticleId";
	    OleDbCommand cmdArticleName = new OleDbCommand( ArticleName, conNewsData );
	    cmdArticleName.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("ArticleId")));
	    conNewsData.Open();
	    Object objArticleName = cmdArticleName.ExecuteScalar();
	    comArticleName = objArticleName.ToString();
	    conNewsData.Close();
	    lblArticleName.Text = comArticleName;
		
	    string comArticleComments;
	    string ArticleComments = "SELECT ArticleComments from ArticleData WHERE ArticleId = @ArticleId";
	    OleDbCommand cmdArticleComments = new OleDbCommand( ArticleComments, conNewsData );
	    cmdArticleComments.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("ArticleId")));
	    conNewsData.Open();
	    Object objArticleComments = cmdArticleComments.ExecuteScalar();
	    comArticleComments = objArticleComments.ToString();
	    conNewsData.Close();
	    lblArticleComments.Text = comArticleComments;	
 	}
		
	public void subcomButton_Click(object sender , System.EventArgs e) 

	{
	    if (CommentContent.Text != "") 
        {
	        FormsIdentity objUserIdentity;
	        FormsAuthenticationTicket objTicket;
	        DateTime Timestamp = DateTime.Now;
            TriptychBlogSettings TBSettings = new TriptychBlogSettings();
            string timeData = Timestamp.ToString("G") + " " + TBSettings.Timezone();
	        string comUserName;

	        if (User.Identity.IsAuthenticated)
		    {
			    objUserIdentity = (FormsIdentity)User.Identity;
			    objTicket = (FormsAuthenticationTicket)objUserIdentity.Ticket;
			    comUserName = objUserIdentity.Name.ToString();
		    }
		    else
		    {
			    comUserName = "Guest";
		    }

	        string comIP = Request.UserHostAddress.ToString();
	        string comContent = BBCode(CommentContent.Text);
	        string comId = Request.QueryString.Get("ArticleId");
	        string comName = Request.QueryString.Get("ArticleName");
	        string QueryArticleId = Request.QueryString.Get("ArticleId");
	        string comNumber;
	        string comTotal;
	        string artLastUser;
	        string artName;
	        string comBrowser = Request.Browser.Browser + "  " + Request.Browser.Version;
    		
	        OleDbConnection conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("./NewsData.mdb") );
	        string MaxComment = "SELECT MAX(CommentNumber) from CommentData WHERE CommentId = @CommentId";
	        OleDbCommand cmdCommentNumber = new OleDbCommand( MaxComment, conNewsData );
	        cmdCommentNumber.Parameters.Add(new OleDbParameter("@CommentId", Request.QueryString.Get("ArticleId")));
	        conNewsData.Open();
	        Object objMax = cmdCommentNumber.ExecuteScalar();
	        if (objMax != DBNull.Value) 
            {
		        int intMax = Convert.ToInt32(objMax);
		        comNumber = (intMax + 1).ToString();
		    }
	        else 
            {
		        comNumber = "1"; 
		    }

	        conNewsData.Close();

	        string strInsert = "Insert Into CommentData ( CommentDate, CommentId, CommentContent, CommentUserName, CommentName, CommentNumber, IPAddress, BrowserType  ) Values (@timeData, @comId, @comContent, @comUserName, @comName, @comNumber, @comIP, @comBrowser)";	
	        OleDbCommand cmdInsert = new OleDbCommand( strInsert, conNewsData );
	        cmdInsert.Parameters.Add( "@timeData", timeData );
	        cmdInsert.Parameters.Add( "@comId", comId );
	        cmdInsert.Parameters.Add( "@comContent", comContent );
	        cmdInsert.Parameters.Add( "@comUserName", comUserName );
	        cmdInsert.Parameters.Add( "@comName", comName );
	        cmdInsert.Parameters.Add( "@comNumber", comNumber );
	        cmdInsert.Parameters.Add( "@comIP", comIP );
	        cmdInsert.Parameters.Add( "@comBrowser", comBrowser );
	        conNewsData.Open();
	        cmdInsert.ExecuteNonQuery();
	        conNewsData.Close();
    		
	        string TotalComment = "SELECT Count(CommentNumber) from CommentData WHERE CommentId = @CommentId";
	        OleDbCommand cmdCommentTotal = new OleDbCommand( TotalComment, conNewsData );
	        cmdCommentTotal.Parameters.Add(new OleDbParameter("@CommentId", Request.QueryString.Get("ArticleId")));
	        conNewsData.Open();
	        Object objTotal = cmdCommentTotal.ExecuteScalar();
	        comTotal = objTotal.ToString();
	        conNewsData.Close();
    		
	        string strUpdate = "UPDATE ArticleData SET ArticleComments = @Total WHERE ArticleId = @ArticleId";
	        OleDbCommand cmdUpdateDB = new OleDbCommand( strUpdate, conNewsData );
	        cmdUpdateDB.Parameters.Add(new OleDbParameter("@Total", comTotal));
	        cmdUpdateDB.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("ArticleId")));
	        conNewsData.Open();
	        cmdUpdateDB.ExecuteNonQuery();
	        conNewsData.Close();
    		
	        string ArticleName = "SELECT ArticleName from ArticleData where ArticleId = @ArticleId";
	        OleDbCommand cmdReadArticleName = new OleDbCommand( ArticleName, conNewsData );
	        cmdReadArticleName.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("ArticleId")));
	        conNewsData.Open();
	        Object objArticleName = cmdReadArticleName.ExecuteScalar();
	        artName = objArticleName.ToString();
	        conNewsData.Close();
		
	        string LastComment = "SELECT CommentUserName from CommentData where CommentNumber = @Number AND CommentId = @CommentId";
	        OleDbCommand cmdReadCommentDB = new OleDbCommand( LastComment, conNewsData );
	        cmdReadCommentDB.Parameters.Add(new OleDbParameter("@Number", comNumber));
	        cmdReadCommentDB.Parameters.Add(new OleDbParameter("@CommentId", Request.QueryString.Get("ArticleId")));
	        conNewsData.Open();
	        Object objLastComment = cmdReadCommentDB.ExecuteScalar();
	        if (objLastComment != DBNull.Value) 
            {
		        artLastUser = "<a href='./Comments.aspx?ArticleId=" +  Request.QueryString.Get("ArticleId").ToString() + "&amp;ArticleName=" + artName + "#" + comTotal + "' class='ContentFooter'>Last comment</a> was by <a class='ContentFooterUser' href='#'>" + objLastComment.ToString() + "</a>";
		    }
	        else 
            {
		        artLastUser = "<a class='ContentFooter' href='./Comments.aspx?ArticleId=" + Request.QueryString.Get("ArticleId").ToString() + "&amp;ArticleName=" + artName + "'>Be the First to Submit a Comment</a>";
		    }
	
	        conNewsData.Close();
				
	        string strUpdateLastUser = "UPDATE ArticleData SET LastComment = @LastComment WHERE ArticleId = @ArticleId";
	        OleDbCommand cmdUpdateLastUserDB = new OleDbCommand( strUpdateLastUser, conNewsData );
	        cmdUpdateLastUserDB.Parameters.Add(new OleDbParameter("@LastComment", artLastUser));
	        cmdUpdateLastUserDB.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("ArticleId")));
	        conNewsData.Open();
	        cmdUpdateLastUserDB.ExecuteNonQuery();
	        conNewsData.Close();
    		
	        Response.Redirect(Request.UrlReferrer.ToString());
	    }
	}
    public string BBCode(string strRaw)
    {
        /*RegexOptions rxOptions = RegexOptions.IgnoreCase | RegexOptions.Multiline | RegexOptions.Singleline;
        Regex rURL1 = new Regex( @"\[url\](?<http>(http://)|(https://)|(ftp://)|(ftps://))?(?<inner>(.*?))\[/url\]", rxOptions );
        Regex rURL2 = new Regex( @"\[url=(?<http>(http://)|(https://)|(ftp://)|(ftps://))?(?<url>[^\]]*)\](?<inner>(.*?))\[/url\]", rxOptions );
        
        strRaw = rURL1.Replace(strRaw, @"$1");
        strRaw = rURL2.Replace(strRaw, @"$2");*/ 

        return strRaw;
    }
}

namespace Feed
{
    public class Rss : System.Web.UI.Page
    {
        protected System.Web.UI.WebControls.Repeater RSS;
        protected System.Web.UI.WebControls.Literal Title;
        protected System.Web.UI.WebControls.Literal Description;

        protected void Page_Load(object sender, System.EventArgs e)
        {
            TriptychBlogSettings TBSettings = new TriptychBlogSettings();
            Title.Text = TBSettings.Title();
            Description.Text = TBSettings.Title();
            
            OleDbConnection conNewsData;
            OleDbCommand cmdSelectDB;
            OleDbDataReader dtrArticleData;

            conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("./NewsData.mdb"));
            conNewsData.Open();
            cmdSelectDB = new OleDbCommand("Select * From ArticleData WHERE Hidden = 'No' ORDER BY ArticleId DESC", conNewsData);
            dtrArticleData = cmdSelectDB.ExecuteReader();
            RSS.DataSource = dtrArticleData;
            RSS.DataBind();
            conNewsData.Close();
        }
    }

    public class Atom : System.Web.UI.Page
    {
        protected System.Web.UI.WebControls.Repeater ATOM;
        protected System.Web.UI.WebControls.Literal Title;
        protected System.Web.UI.WebControls.Literal Title2;
        protected System.Web.UI.WebControls.Literal Title3;
        protected System.Web.UI.WebControls.Literal Description;
        protected System.Web.UI.WebControls.Literal Timezone;

        protected void Page_Load(object sender, System.EventArgs e)
        {
            TriptychBlogSettings TBSettings = new TriptychBlogSettings();
            Title.Text = TBSettings.Title();
            Title2.Text = TBSettings.Title();
            Title3.Text = TBSettings.Title();
            Description.Text = TBSettings.Title();
            Timezone.Text = " " + TBSettings.Timezone();

            OleDbConnection conNewsData;
            OleDbCommand cmdSelectDB;
            OleDbDataReader dtrArticleData;

            conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("./NewsData.mdb"));
            conNewsData.Open();
            cmdSelectDB = new OleDbCommand("Select * From ArticleData WHERE Hidden = 'No' ORDER BY ArticleId DESC", conNewsData);
            dtrArticleData = cmdSelectDB.ExecuteReader();
            ATOM.DataSource = dtrArticleData;
            ATOM.DataBind();
            conNewsData.Close();
        }
    }

    public class Format
    {
        public static string ForXML(object input)
        {
            string data = input.ToString();      // cast the input to a string

            // replace those characters disallowed in XML documents
            data = data.Replace("&", "&amp;");
            data = data.Replace("\"", "&quot;");
            data = data.Replace("'", "&apos;");
            data = data.Replace("<p>", "");
            data = data.Replace("</p>", "");
            data = data.Replace("<", "&lt;");
            data = data.Replace(">", "&gt;");
            
            return data;
        }
        public static string ForURL(object input)
        {
            string data = input.ToString();      // cast the input to a string

            // replace those characters disallowed in URL Strings
            data = data.Replace(" ", "%20");
            data = data.Replace("&", "&amp;");

            return data;
        }
    }
}