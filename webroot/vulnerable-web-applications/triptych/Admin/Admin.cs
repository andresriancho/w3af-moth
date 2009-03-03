/*/////////////////////////////////////////////////////////////////////
 *                                                                   *
 *                        TRIPTYCHBLOG v.9.0.1                         *
 *       Copyright 2007 TriptychStudios. All Rights Reservered.      *
 *                                                                   *
 * Filename: Admin.cs                                                *
 * Modified: June 15th, 2007                                         *
 * Author: TriptychStudios                                           *
 * License: GNU General Public License (GPL) 2.0                     *
 *                                                                   *
 * //////////////////////////////////////////////////////////////////*/

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
using System.Drawing.Imaging;
using System.Xml;
using System.Net;
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
    string strFilename = "../Config.xml";

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
    public static string strFilename = "../Config.xml";

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
    protected System.Web.UI.WebControls.Literal Title;
    protected System.Web.UI.WebControls.Literal Version;

    protected void Page_Load(object sender, System.EventArgs e)
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        Version.Text = TBSettings.Version();
    }
}

public class Default : System.Web.UI.Page
{
    protected System.Web.UI.WebControls.Literal lblName;
    protected System.Web.UI.WebControls.Literal Title;

    void Page_Load(Object sender , EventArgs e) 
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        
        FormsIdentity objUserIdentity;
        objUserIdentity = (FormsIdentity)User.Identity;
        lblName.Text = objUserIdentity.Name.ToString();
    }
}

public class AddNews : System.Web.UI.Page
{
    protected System.Web.UI.WebControls.TextBox ArticleName;
    protected System.Web.UI.WebControls.TextBox ArticleContent;
    protected System.Web.UI.WebControls.Button dbButton;
    protected System.Web.UI.WebControls.DropDownList Hidden;
    protected System.Web.UI.WebControls.DropDownList Comments;
    protected System.Web.UI.WebControls.DropDownList Category;
    protected System.Web.UI.WebControls.Literal Title;

    void Page_Load( Object sender, EventArgs e ) 
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        
        if (!IsPostBack)
	    {
		    BindCategoryList();
	    }
    	
    }

    void BindCategoryList ()
    {
        XmlDocument xmlConfig = new XmlDocument();
        xmlConfig.Load(Server.MapPath("../Config.xml"));

        XmlNodeList xmlCategory = xmlConfig.SelectNodes("config/category/item");
        ArrayList alCategory = new ArrayList();

        foreach (XmlNode Item in xmlCategory)
        {
            alCategory.Add(Item.InnerText);
        }

        Category.DataSource = alCategory;
        Category.DataBind();
    }

    public void AddButton_Click(Object sender , EventArgs e) 
    {
        OleDbConnection conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb") );
        string strInsert;
        DateTime Timestamp;
        OleDbCommand cmdInsert;
        string timeData;
        string artName;
        string artContent;
        string artUserName;
        string artId;
        string artHidden;
        string artLastComment;
        string artCategory;
        string artCommentProtection;
        int artComments = 0;
        FormsIdentity objUserIdentity;
        objUserIdentity = (FormsIdentity)User.Identity;

        Timestamp = DateTime.Now;
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        timeData = Timestamp.ToString("G") + " " + TBSettings.Timezone();
        artName = ArticleName.Text;
        artContent = ArticleContent.Text;
        artUserName = objUserIdentity.Name.ToString();
        artHidden = Hidden.SelectedItem.Text.ToString();
        artCategory = Category.SelectedItem.Text.ToString();
        artCommentProtection = Comments.SelectedItem.Text.ToString();

        string MaxArticle = "SELECT MAX(ArticleId) from ArticleData";
        DataSet ArticleDS = new DataSet();
        OleDbCommand cmdArticleId = new OleDbCommand( MaxArticle, conNewsData );
        OleDbDataAdapter adpSelectMax = new OleDbDataAdapter();
        adpSelectMax.SelectCommand = cmdArticleId;
        adpSelectMax.Fill( ArticleDS, "ArticleData" );
        conNewsData.Open();
        Object objMax = cmdArticleId.ExecuteScalar();

        if (objMax != DBNull.Value) 
        {
	        int intMax = Convert.ToInt32(objMax);
	        artId = (intMax + 1).ToString();
        }
        else 
        {
	        artId = "1"; 
	    }
    		
        conNewsData.Close();

        artLastComment = "<a class='ContentFooter' href='./Comments.aspx?ArticleId=" + artId + "&amp;ArticleName=" + ArticleName.Text + "'>Be the First to Submit a Comment</a>";

        strInsert = "Insert Into ArticleData ( ArticleDate, ArticleName, ArticleContent, ArticleUserName, ArticleId, Hidden, ArticleComments, LastComment, Category, CommentProtection ) Values (@timeData, @artName, @artContent, @UserName, @artId, @artHidden, @artComments, @artLasComment, @artCategory, @artCommentProtection)";
        cmdInsert = new OleDbCommand( strInsert, conNewsData );
        cmdInsert.Parameters.Add( "@timeData", timeData );
        cmdInsert.Parameters.Add( "@artName", artName );
        cmdInsert.Parameters.Add( "@artContent", artContent );
        cmdInsert.Parameters.Add( "@artUserName", artUserName );
        cmdInsert.Parameters.Add( "@artId", artId );
        cmdInsert.Parameters.Add( "@artHidden", artHidden );
        cmdInsert.Parameters.Add( "@artComments", artComments);
        cmdInsert.Parameters.Add( "@artLastComment", artLastComment);
        cmdInsert.Parameters.Add( "@artCategory", artCategory);
        cmdInsert.Parameters.Add( "@artCommentProtection", artCommentProtection);
        conNewsData.Open();
        cmdInsert.ExecuteNonQuery();
        conNewsData.Close();
        Response.Redirect( "./" );
    }

    public void PreviewButton_Click(Object sender , EventArgs e) 
    {

    }
}

public class ManageNews : System.Web.UI.Page
{
    protected System.Web.UI.WebControls.DropDownList DBAction;
    protected System.Web.UI.WebControls.Button Go;
    protected System.Web.UI.WebControls.DataGrid Content;
    protected System.Web.UI.WebControls.CheckBox Select;
    protected System.Web.UI.WebControls.Panel List;
    protected System.Web.UI.WebControls.Panel Edit;
    protected System.Web.UI.WebControls.Literal Title;

    void Page_Load( Object sender, EventArgs e ) 
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        
        if (! IsPostBack )
	    {
		    BindDataGrid();
	    }
    }
	
    void BindDataGrid ()
    {
        OleDbConnection conNewsData;
        OleDbCommand cmdSelectDB;
        OleDbDataReader dtrArticleData;

        conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb") );
        conNewsData.Open();
        cmdSelectDB = new OleDbCommand( "Select * From ArticleData ORDER BY ArticleId DESC", conNewsData );
        dtrArticleData = cmdSelectDB.ExecuteReader();
        Content.DataSource = dtrArticleData;  
        Content.DataBind(); 
        conNewsData.Close();
    }

    public void GoButton_Click(Object sender , EventArgs e) 
    {		
	    string SelectedAction = DBAction.SelectedItem.Text.ToString();
	    OleDbConnection conNewsData;
	    OleDbCommand cmdDeleteDB;
	    string strDelete = "";
    					
	    foreach (DataGridItem chkboxDataGridItem in Content.Items) 
        {
		    System.Web.UI.WebControls.CheckBox slctCheckBox = (CheckBox)chkboxDataGridItem.FindControl("Select");
			    if (slctCheckBox.Checked & SelectedAction=="Delete") 
                {
			        string strArticleId = ((Label)(chkboxDataGridItem.FindControl("hdnArticleId"))).Text;
				    conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb") );
				    strDelete = "Delete from ArticleData WHERE ArticleId = @ArticleName";
				    cmdDeleteDB = new OleDbCommand( strDelete, conNewsData );
				    cmdDeleteDB.Parameters.Add(new OleDbParameter("@ArticleId",  strArticleId));
				    conNewsData.Open();
				    cmdDeleteDB.ExecuteNonQuery();
				    conNewsData.Close();
			    }
			    else if (slctCheckBox.Checked & SelectedAction=="Hide")
                {
			        string strArticleId = ((Label)(chkboxDataGridItem.FindControl("hdnArticleId"))).Text;
				    conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb") );
				    strDelete = "UPDATE ArticleData SET Hidden = 'Yes' WHERE ArticleId = @ArticleName";
				    cmdDeleteDB = new OleDbCommand( strDelete, conNewsData );
				    cmdDeleteDB.Parameters.Add(new OleDbParameter("@ArticleId",  strArticleId));
				    conNewsData.Open();
				    cmdDeleteDB.ExecuteNonQuery();
				    conNewsData.Close();
			    }
			    else if (slctCheckBox.Checked & SelectedAction=="Show")
                {
			        string strArticleId = ((Label)(chkboxDataGridItem.FindControl("hdnArticleId"))).Text;
				    conNewsData = new OleDbConnection( "PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb") );
				    strDelete = "UPDATE ArticleData SET Hidden = 'No' WHERE ArticleId = @ArticleName";
				    cmdDeleteDB = new OleDbCommand( strDelete, conNewsData );
				    cmdDeleteDB.Parameters.Add(new OleDbParameter("@ArticleId",  strArticleId));
				    conNewsData.Open();
				    cmdDeleteDB.ExecuteNonQuery();
				    conNewsData.Close();
			    }
        }
	    Response.Redirect(Request.Url.ToString());
    }  
}

public class EditNews : System.Web.UI.Page
{
    protected System.Web.UI.WebControls.Button UpdateButton;
    protected System.Web.UI.WebControls.Button PreviewButton;
    protected System.Web.UI.WebControls.DropDownList DBAction;
    protected System.Web.UI.WebControls.Button Go;
    protected System.Web.UI.WebControls.DataGrid Content;
    protected System.Web.UI.WebControls.Repeater ArticleRepeater;
    protected System.Web.UI.WebControls.CheckBox Select;
    protected System.Web.UI.WebControls.TextBox ArticleName;
    protected System.Web.UI.WebControls.TextBox ArticleContent;
    protected System.Web.UI.WebControls.DropDownList Hidden;
    protected System.Web.UI.WebControls.DropDownList Comments;
    protected System.Web.UI.WebControls.DropDownList Category;
    protected System.Web.UI.WebControls.Literal Title;


    public void UpdateButton_Click(Object sender, EventArgs e)
    {
        string artHidden = Hidden.SelectedItem.Text.ToString();
        string artCategory = Category.SelectedItem.Text.ToString();
        string artCommentProtection = Comments.SelectedItem.Text.ToString();
        OleDbConnection conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb"));
        string strUpdate = "UPDATE ArticleData SET ArticleName = @ArticleName, ArticleContent = @ArticleContent,  Hidden = @ArticleHidden, Category = @ArticleCategory, CommentProtection = @ArticleCommentProtection WHERE ArticleId = @ArticleID";
        OleDbCommand cmdUpdateDB = new OleDbCommand(strUpdate, conNewsData);
        cmdUpdateDB.Parameters.Add(new OleDbParameter("@ArticleName", ArticleName.Text));
        cmdUpdateDB.Parameters.Add(new OleDbParameter("@ArticleContent", ArticleContent.Text));
        cmdUpdateDB.Parameters.Add(new OleDbParameter("@ArticleHidden", artHidden));
        cmdUpdateDB.Parameters.Add(new OleDbParameter("@ArticleCategory", artCategory));
        cmdUpdateDB.Parameters.Add(new OleDbParameter("@ArticleCommenntProtection", artCommentProtection));
        cmdUpdateDB.Parameters.Add(new OleDbParameter("@ArticleID", Request.QueryString.Get("Edit")));
        conNewsData.Open();
        cmdUpdateDB.ExecuteNonQuery();
        conNewsData.Close();

        Response.Redirect("managenews.aspx");
    }

    public void PreviewButton_Click(Object sender, EventArgs e)
    {
        ///
    }

    void Page_Load(Object sender, EventArgs e)
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        
        if (!IsPostBack)
        {
            BindDataGrid();
            BindCategoryList();
            BindTextBox();
            BindDropDownLists();
        }
    }

    void BindDataGrid()
    {
        OleDbConnection conNewsData;
        OleDbCommand cmdSelectCommentDB;
        OleDbDataReader dtrCommentData;

        conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb"));
        conNewsData.Open();
        cmdSelectCommentDB = new OleDbCommand("Select * From CommentData Where CommentId = @ArticleId ORDER BY CommentNumber ASC", conNewsData);
        cmdSelectCommentDB.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("Edit")));
        dtrCommentData = cmdSelectCommentDB.ExecuteReader();
        Content.DataSource = dtrCommentData;
        Content.DataBind();
        conNewsData.Close();
    }

    void BindCategoryList()
    {
        XmlDocument xmlConfig = new XmlDocument();
        xmlConfig.Load(Server.MapPath("../Config.xml"));

        XmlNodeList xmlCategory = xmlConfig.SelectNodes("config/category/item");
        ArrayList alCategory = new ArrayList();

        foreach (XmlNode Item in xmlCategory)
        {
            alCategory.Add(Item.InnerText);
        }

        Category.DataSource = alCategory;
        Category.DataBind();
    }

    void BindTextBox()
    {
        OleDbConnection conNewsData;
        OleDbCommand cmdSelectArticleDB;
        OleDbDataReader dtrArticleData;

        conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb"));
        conNewsData.Open();
        string ArticleSelect = "Select * From ArticleData Where ArticleId = @ArticleId";
        cmdSelectArticleDB = new OleDbCommand(ArticleSelect, conNewsData);
        cmdSelectArticleDB.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("Edit")));
        dtrArticleData = cmdSelectArticleDB.ExecuteReader();
        dtrArticleData.Read();
        ArticleName.Text = dtrArticleData["ArticleName"].ToString();
        ArticleContent.Text = dtrArticleData["ArticleContent"].ToString();
        dtrArticleData.Close();
        conNewsData.Close();
    }

    void BindDropDownLists()
    {
        OleDbConnection conNewsData;
        OleDbCommand cmdSelectArticleDB;
        OleDbDataReader dtrArticleData;

        conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb"));
        conNewsData.Open();
        string ArticleSelect = "Select * From ArticleData Where ArticleId = @ArticleId";
        cmdSelectArticleDB = new OleDbCommand(ArticleSelect, conNewsData);
        cmdSelectArticleDB.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("Edit")));
        dtrArticleData = cmdSelectArticleDB.ExecuteReader();
        dtrArticleData.Read();
        Hidden.SelectedValue = dtrArticleData["Hidden"].ToString();
        Comments.SelectedValue = dtrArticleData["CommentProtection"].ToString();
        Category.SelectedValue = dtrArticleData["Category"].ToString();
        dtrArticleData.Close();
        conNewsData.Close();
    }

    public void GoButton_Click(Object sender, EventArgs e)
    {
        string SelectedAction = DBAction.SelectedItem.Text.ToString();
        OleDbConnection conNewsData;
        OleDbCommand cmdDeleteDB;
        string strDelete = "";
        string artLastUser = "";
        string comNumber;
        string artName;
        string comTotal;

        foreach (DataGridItem chkboxDataGridItem in Content.Items)
        {
            System.Web.UI.WebControls.CheckBox slctCheckBox = (CheckBox)chkboxDataGridItem.FindControl("Select");
            if (slctCheckBox.Checked & SelectedAction == "Delete")
            {
                string strCommentNumber = ((Label)(chkboxDataGridItem.FindControl("hdnCommentNumber"))).Text;
                conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb"));
                strDelete = "Delete From CommentData Where CommentNumber = @CommentNumber AND CommentId = @CommentId";
                cmdDeleteDB = new OleDbCommand(strDelete, conNewsData);
                cmdDeleteDB.Parameters.Add(new OleDbParameter("@CommentNumber", strCommentNumber));
                cmdDeleteDB.Parameters.Add(new OleDbParameter("@CommentId", Request.QueryString.Get("Edit")));
                conNewsData.Open();
                cmdDeleteDB.ExecuteNonQuery();
                conNewsData.Close();
            }
            else if (slctCheckBox.Checked & SelectedAction == "Block IP")
            {
                ///
            }
        }

        conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb"));
        string MaxComment = "SELECT MAX(CommentNumber) from CommentData WHERE CommentId= @CommentId";
        OleDbCommand cmdCommentNumber = new OleDbCommand(MaxComment, conNewsData);
        cmdCommentNumber.Parameters.Add(new OleDbParameter("@CommentId", Request.QueryString.Get("Edit")));
        conNewsData.Open();
        Object objMax = cmdCommentNumber.ExecuteScalar();
        if (objMax != DBNull.Value)
        {
            comNumber = objMax.ToString();
        }
        else
        {
            comNumber = "0";
        }

        conNewsData.Close();

        string TotalComment = "SELECT Count(CommentNumber) from CommentData WHERE CommentId= @CommentId";
        OleDbCommand cmdCommentTotal = new OleDbCommand(TotalComment, conNewsData);
        cmdCommentTotal.Parameters.Add(new OleDbParameter("@CommentId", Request.QueryString.Get("Edit")));
        conNewsData.Open();
        Object objTotal = cmdCommentTotal.ExecuteScalar();
        comTotal = objTotal.ToString();
        conNewsData.Close();

        string strUpdate = "UPDATE ArticleData SET ArticleComments = @Total WHERE ArticleId = @ArticleId";
        OleDbCommand cmdCount = new OleDbCommand(strUpdate, conNewsData);
        cmdCount.Parameters.Add(new OleDbParameter("@Total", comTotal));
        cmdCount.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("Edit")));
        conNewsData.Open();
        cmdCount.ExecuteNonQuery();
        conNewsData.Close();

        string ArticleName = "SELECT ArticleName from ArticleData where ArticleId = @ArticleId";
        OleDbCommand cmdReadArticleName = new OleDbCommand(ArticleName, conNewsData);
        cmdReadArticleName.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("Edit")));
        conNewsData.Open();
        Object objArticleName = cmdReadArticleName.ExecuteScalar();
        artName = objArticleName.ToString();
        conNewsData.Close();

        string LastComment = "SELECT CommentUserName from CommentData where CommentNumber = @CommentNumber AND CommentId = @CommentId";
        OleDbCommand cmdReadCommentDB = new OleDbCommand(LastComment, conNewsData);
        cmdReadCommentDB.Parameters.Add(new OleDbParameter("@CommentNumber", comNumber));
        cmdReadCommentDB.Parameters.Add(new OleDbParameter("@CommentId", Request.QueryString.Get("Edit")));
        conNewsData.Open();
        Object objLastComment = cmdReadCommentDB.ExecuteScalar();
        conNewsData.Close();

        if (comTotal != "0")
        {
            artLastUser = "<a href='./Comments.aspx?ArticleId=" + Request.QueryString.Get("Edit").ToString() + "&amp;ArticleName=" + artName + "#" + comTotal + "' class='ContentFooter'>Last comment</a> was by <a class='ContentFooterUser' href='#'>" + objLastComment.ToString() + "</a>";
        }
        else
        {
            artLastUser = "<a class='ContentFooter' href='./Comments.aspx?ArticleId=" + Request.QueryString.Get("Edit").ToString() + "&amp;ArticleName=" + artName + "'>Be the First to Submit a Comment</a>";
        }

        string strUpdateLastUser = "UPDATE ArticleData SET LastComment = @LastUser WHERE ArticleId = @ArticleId";
        OleDbCommand cmdUpdateLastUserDB = new OleDbCommand(strUpdateLastUser, conNewsData);
        cmdUpdateLastUserDB.Parameters.Add(new OleDbParameter("@LastUser", artLastUser));
        cmdUpdateLastUserDB.Parameters.Add(new OleDbParameter("@ArticleId", Request.QueryString.Get("Edit")));
        conNewsData.Open();
        cmdUpdateLastUserDB.ExecuteNonQuery();
        conNewsData.Close();

        Response.Redirect(Request.Url.ToString());
    }
}

public class Options : System.Web.UI.Page
{
    protected System.Web.UI.WebControls.Button Backup;
    protected System.Web.UI.WebControls.DataGrid Settings;
    protected System.Web.UI.WebControls.DataGrid Category;
    protected System.Web.UI.WebControls.DataGrid Blogroll;
    protected System.Web.UI.WebControls.DataGrid Test;
    protected System.Web.UI.WebControls.Label SettingsError;
    protected System.Web.UI.WebControls.Label CategoryError;
    protected System.Web.UI.WebControls.Label BlogrollError;
    protected System.Web.UI.WebControls.TextBox Title;
    protected System.Web.UI.WebControls.TextBox Description;
    protected System.Web.UI.WebControls.TextBox Language;
    protected System.Web.UI.WebControls.TextBox Display;
    protected System.Web.UI.WebControls.TextBox RecentDisplay;
    protected System.Web.UI.WebControls.TextBox HostIP;
    protected System.Web.UI.WebControls.TextBox Timezone;
    protected System.Web.UI.WebControls.Label Version;
    protected System.Web.UI.WebControls.CheckBox UseCurrent;
    protected System.Web.UI.WebControls.LinkButton SaveSettings;
    protected System.Web.UI.WebControls.Literal litTitle;

    public void Page_Load(object sender, EventArgs e)
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        litTitle.Text = TBSettings.Title();
        
        if (!IsPostBack)
        {
            BindSettings();
            LoadXML();
        }
    }

    public void BindSettings()
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        Description.Text = TBSettings.Description();
        Language.Text = TBSettings.Language();
        Display.Text = TBSettings.Display();
        RecentDisplay.Text = TBSettings.RecentDisplay();
        HostIP.Text = TBSettings.HostIP();
        Timezone.Text = TBSettings.Timezone();
        Version.Text = TBSettings.Version();
    }

    public void SaveSettingsButton_Click(Object sender, EventArgs e)
    {
        if (Title.Text != "" && Description.Text != "" && Language.Text != "" && Display.Text != "" && RecentDisplay.Text != "" && HostIP.Text != "" && Timezone.Text != "" && Version.Text != "")
        {
            string strFilename = "../Config.xml";
            XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));

            DataSet dsSettings = new DataSet();
            dsSettings.ReadXml(srXML);
            srXML.Close();

            XmlTextWriter swXML = new XmlTextWriter(Server.MapPath(strFilename), Encoding.UTF8);

            dsSettings.Tables["settings"].Rows[0]["title"] = Title.Text;
            dsSettings.Tables["settings"].Rows[0]["description"] = Description.Text;
            dsSettings.Tables["settings"].Rows[0]["language"] = Language.Text;
            dsSettings.Tables["settings"].Rows[0]["display"] = Display.Text;
            dsSettings.Tables["settings"].Rows[0]["recentdisplay"] = RecentDisplay.Text;

            if (UseCurrent.Checked == true)
            {
                dsSettings.Tables["settings"].Rows[0]["hostip"] = Request.UserHostAddress.ToString();
            }
            else
            {
                dsSettings.Tables["settings"].Rows[0]["hostip"] = HostIP.Text;
            }

            dsSettings.Tables["settings"].Rows[0]["timezone"] = Timezone.Text;
            dsSettings.Tables["settings"].Rows[0]["version"] = Version.Text;

            swXML.Formatting = Formatting.Indented;
            swXML.Indentation = 4;
            swXML.WriteStartDocument();
            dsSettings.WriteXml(swXML);
            swXML.Close();

            BindSettings();
        }
        else
        {
            SettingsError.Text = "Error! Please complete all fields.";
            SettingsError.Visible = true;
        }
    }

    public void LoadXML()
    {
        string strFilename = "../Config.xml";

        if (!File.Exists(Server.MapPath(strFilename)))
        {
             Config.New();
             LoadXML();
        }

        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));
        DataSet dsXML = new DataSet();

        try
        {
            dsXML.ReadXml(srXML);
            if (dsXML.Tables["category"] == null && dsXML.Tables["blogroll"] == null)
            {
                srXML.Close();
                Config.Category();
                Config.Blogroll();
                LoadXML();
            }
            else if (dsXML.Tables["category"] == null)
            {
                dsXML.ReadXml(srXML);
                Blogroll.DataSource = dsXML.Tables["blogroll"];
                Blogroll.DataBind();
                srXML.Close();

                Config.Category();
                LoadXML();
            }
            else if (dsXML.Tables["blogroll"] == null)
            {
                dsXML.ReadXml(srXML);
                Category.DataSource = dsXML.Tables["category"];
                Category.DataBind();
                srXML.Close();

                Config.Blogroll();
                LoadXML();
            }
            else
            {
                Category.DataSource = dsXML.Tables["category"];
                Category.DataBind();

                Blogroll.DataSource = dsXML.Tables["blogroll"];
                Blogroll.DataBind();

                srXML.Close();
            }
        }
        catch
        {
            srXML.Close();
        }
    }

    public void SetEditModeCategory(object Sender, DataGridCommandEventArgs e)
    {
        string strFilename = "../Config.xml";
        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));
        
        DataSet objdata = new DataSet();
        string x1;

        objdata.ReadXml(srXML);
        srXML.Close();

        x1 = Category.DataKeys[e.Item.ItemIndex].ToString();

        objdata.Tables["category"].DefaultView.RowFilter = "item='" + x1 + "'";

        if (objdata.Tables["category"].DefaultView.Count > 0)
        {
            CategoryError.Visible = false;
            Category.EditItemIndex = e.Item.ItemIndex;
            Category.ShowFooter = false;
            LoadXML();
        }
        else
        {
            CategoryError.Text = "Error! The Record you are trying to Edit has been deleted by another user!";
            CategoryError.Visible = true;
        }
    }

    public void SetEditModeBlogroll(object Sender, DataGridCommandEventArgs e)
    {
        string strFilename = "../Config.xml";
        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));

        DataSet objdata = new DataSet();
        string x1;

        objdata.ReadXml(srXML);
        srXML.Close();

        x1 = Blogroll.DataKeys[e.Item.ItemIndex].ToString();

        objdata.Tables["blogroll"].DefaultView.RowFilter = "title='" + x1 + "'";

        if (objdata.Tables["blogroll"].DefaultView.Count > 0)
        {
            BlogrollError.Visible = false;
            Blogroll.EditItemIndex = e.Item.ItemIndex;
            Blogroll.ShowFooter = false;
            LoadXML();
        }
        else
        {
            BlogrollError.Text = "Error! The Record you are trying to Edit has been deleted by another user!";
            BlogrollError.Visible = true;
        }
    }

    public void CancelEditCategory(object sender, DataGridCommandEventArgs e)
    {
        Category.EditItemIndex = -1;
        Category.ShowFooter = true;
        CategoryError.Visible = false;

        LoadXML();
    }

    public void CancelEditBlogroll(object sender, DataGridCommandEventArgs e)
    {
        Blogroll.EditItemIndex = -1;
        Blogroll.ShowFooter = true;
        BlogrollError.Visible = false;

        LoadXML();
    }

    public void DelXMLCategory(object sender, DataGridCommandEventArgs e)
    {
        string strFilename = "../Config.xml";
        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));

        if (e.CommandName == "Delete")
        {
            if (Category.EditItemIndex == -1)
            {
                CategoryError.Visible = false;
                string x1;

                x1 = Category.DataKeys[e.Item.ItemIndex].ToString();

                DataSet objdata = new DataSet();
                try
                {
                    objdata.ReadXml(srXML);
                    srXML.Close();

                    XmlTextWriter swXML = new XmlTextWriter(Server.MapPath(strFilename), Encoding.UTF8);

                    objdata.Tables["category"].DefaultView.RowFilter = "item='" + x1 + "'";
                    if (objdata.Tables["category"].DefaultView.Count > 0)
                    {
                        objdata.Tables["category"].DefaultView.Delete(0);
                    }

                    objdata.Tables["category"].DefaultView.RowFilter = "";

                    swXML.Formatting = Formatting.Indented;
                    swXML.Indentation = 4;
                    swXML.WriteStartDocument();
                    objdata.WriteXml(swXML);
                    swXML.Close();
                }
                catch
                {
                    ///
                }

                LoadXML();
            }
            else
            {
                CategoryError.Text = "Error! The Record cannot be deleted while in Edit Mode";
                CategoryError.Visible = true;
            }
        }
    }

    public void DelXMLBlogroll(object sender, DataGridCommandEventArgs e)
    {
        string strFilename = "../Config.xml";
        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));

        if (e.CommandName == "Delete")
        {
            if (Blogroll.EditItemIndex == -1)
            {
                BlogrollError.Visible = false;
                string x1;

                x1 = Blogroll.DataKeys[e.Item.ItemIndex].ToString();

                DataSet objdata = new DataSet();
                try
                {
                    objdata.ReadXml(srXML);
                    srXML.Close();

                    XmlTextWriter swXML = new XmlTextWriter(Server.MapPath(strFilename), Encoding.UTF8);

                    objdata.Tables["blogroll"].DefaultView.RowFilter = "title='" + x1 + "'";
                    if (objdata.Tables["blogroll"].DefaultView.Count > 0)
                    {
                        objdata.Tables["blogroll"].DefaultView.Delete(0);
                    }

                    objdata.Tables["blogroll"].DefaultView.RowFilter = "";

                    swXML.Formatting = Formatting.Indented;
                    swXML.Indentation = 4;
                    swXML.WriteStartDocument();
                    objdata.WriteXml(swXML);
                    swXML.Close();
                }
                catch
                {
                    ///
                }

                LoadXML();
            }
            else
            {
                BlogrollError.Text = "Error! The Record cannot be deleted while in Edit Mode";
                BlogrollError.Visible = true;
            }
        }
    }

    public void UpdateXMLCategory(object sender, DataGridCommandEventArgs e)
    {
        string strFilename = "../Config.xml";
        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));
        
        if (e.CommandName == "Update")
        {
            int intRow;
            DataSet objdata = new DataSet();
            string strCategory;

            objdata.ReadXml(srXML);
            srXML.Close();

            XmlTextWriter swXML = new XmlTextWriter(Server.MapPath(strFilename), Encoding.UTF8);

            intRow = Convert.ToInt32(e.Item.ItemIndex);

            strCategory = Category.DataKeys[e.Item.ItemIndex].ToString();

            objdata.Tables["category"].DefaultView.RowFilter = "item='" + strCategory + "'";

            if (objdata.Tables["category"].DefaultView.Count > 0)
            {
                CategoryError.Visible = false;

                objdata.Tables["category"].Rows[intRow]["item"] = ((TextBox)e.Item.FindControl("Category_Edit")).Text;
                Category.DataSource = objdata.Tables["category"];
                Category.DataBind();

                swXML.Formatting = Formatting.Indented;
                swXML.Indentation = 4;
                swXML.WriteStartDocument();
                objdata.WriteXml(swXML);
                swXML.Close();

                Category.EditItemIndex = -1;
                Category.ShowFooter = true;
                LoadXML();
            }
            else
            {
                CategoryError.Text = "Error! The Record you are updating has been deleted by another user!";
                CategoryError.Visible = true;
            }
        }
    }

    public void UpdateXMLBlogroll(object sender, DataGridCommandEventArgs e)
    {
        string strFilename = "../Config.xml";
        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));

        if (e.CommandName == "Update")
        {
            int intRow;
            DataSet objdata = new DataSet();
            string strBlogroll;

            objdata.ReadXml(srXML);
            srXML.Close();

            XmlTextWriter swXML = new XmlTextWriter(Server.MapPath(strFilename), Encoding.UTF8);

            intRow = Convert.ToInt32(e.Item.ItemIndex);

            strBlogroll = Blogroll.DataKeys[e.Item.ItemIndex].ToString();

            objdata.Tables["blogroll"].DefaultView.RowFilter = "title='" + strBlogroll + "'";

            if (objdata.Tables["blogroll"].DefaultView.Count > 0)
            {
                BlogrollError.Visible = false;

                objdata.Tables["blogroll"].Rows[intRow]["title"] = ((TextBox)e.Item.FindControl("Title_Edit")).Text;
                objdata.Tables["blogroll"].Rows[intRow]["link"] = ((TextBox)e.Item.FindControl("Link_Edit")).Text;
                Blogroll.DataSource = objdata.Tables["blogroll"];
                Blogroll.DataBind();

                swXML.Formatting = Formatting.Indented;
                swXML.Indentation = 4;
                swXML.WriteStartDocument();
                objdata.WriteXml(swXML);
                swXML.Close();

                Blogroll.EditItemIndex = -1;
                Blogroll.ShowFooter = true;
                LoadXML();
            }
            else
            {
                BlogrollError.Text = "Error! The Record you are updating has been deleted by another user!";
                BlogrollError.Visible = true;
            }
        }
    }

    public void DoInsertCategory(object sender, DataGridCommandEventArgs e)
    {
        string strFilename = "../Config.xml";
        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));
        
        if (e.CommandName == "doAdd")
        {
            string v1;
            TextBox tbCategory;
            DataSet objdata = new DataSet();
            DataRow dr;

            objdata.ReadXml(srXML);
            srXML.Close();

            tbCategory = (TextBox)e.Item.FindControl("Category_Add");

            CategoryError.Visible = false;

            if (tbCategory.Text.Length < 1)
            {
                tbCategory.Text = "";
                CategoryError.Text = "Error! Category field cannot be blank.";
                CategoryError.Visible = true;
            }

            if (tbCategory.Text != "")
            {
                XmlTextWriter swXML = new XmlTextWriter(Server.MapPath(strFilename), Encoding.UTF8);
                
                objdata.Tables["category"].DefaultView.RowFilter = "item='" + tbCategory.Text + "'";
                if (objdata.Tables["category"].DefaultView.Count <= 0)
                {
                    CategoryError.Visible = false;
                    objdata.Tables["category"].DefaultView.RowFilter = "";
                    dr = objdata.Tables["category"].NewRow();

                    dr[0] = tbCategory.Text;
                    objdata.Tables["category"].Rows.Add(dr);

                    swXML.Formatting = Formatting.Indented;
                    swXML.Indentation = 4;
                    swXML.WriteStartDocument();
                    objdata.WriteXml(swXML);
                    swXML.Close();
                    LoadXML();
                }
                else
                {
                    CategoryError.Text = "Error! Category field must be unique.";
                    CategoryError.Visible = true;
                    swXML.Close();
                }
            }
        }
    }

    public void DoInsertBlogroll(object sender, DataGridCommandEventArgs e)
    {
        string strFilename = "../Config.xml";
        XmlTextReader srXML = new XmlTextReader(Server.MapPath(strFilename));

        if (e.CommandName == "doAdd")
        {
            string v1;
            TextBox tbTitle;
            TextBox tbLink;
            DataSet objdata = new DataSet();
            DataRow dr;

            objdata.ReadXml(srXML);
            srXML.Close();

            tbTitle = (TextBox)e.Item.FindControl("Title_Add");
            tbLink = (TextBox)e.Item.FindControl("Link_Add");

            BlogrollError.Visible = false;

            if (tbTitle.Text.Length < 1 || tbLink.Text.Length < 1)
            {
                tbTitle.Text = "";
                tbLink.Text = "";
                BlogrollError.Text = "Error! Title and/or Link field(s) cannot be blank.";
                BlogrollError.Visible = true;
            }

            if (tbTitle.Text != "" && tbLink.Text != "")
            {
                XmlTextWriter swXML = new XmlTextWriter(Server.MapPath(strFilename), Encoding.UTF8);

                objdata.Tables["blogroll"].DefaultView.RowFilter = "title='" + tbTitle.Text + "'";
                if (objdata.Tables["blogroll"].DefaultView.Count <= 0)
                {
                    CategoryError.Visible = false;
                    objdata.Tables["blogroll"].DefaultView.RowFilter = "";
                    dr = objdata.Tables["blogroll"].NewRow();

                    dr[0] = tbTitle.Text;
                    dr[1] = tbLink.Text;
                    objdata.Tables["blogroll"].Rows.Add(dr);

                    swXML.Formatting = Formatting.Indented;
                    swXML.Indentation = 4;
                    swXML.WriteStartDocument();
                    objdata.WriteXml(swXML);
                    swXML.Close();
                    LoadXML();
                }
                else
                {
                    BlogrollError.Text = "Error! Title and Link fields must be unique.";
                    BlogrollError.Visible = true;
                    swXML.Close();
                }
            }
        }
    }

    public void BackupButton_Click(Object sender, EventArgs e)
    {
        Response.Redirect("./backup.aspx");
    }
}

public class Help : System.Web.UI.Page
{
    protected System.Web.UI.WebControls.Literal litHelp;
    protected System.Web.UI.WebControls.Literal Title;

    void Page_Load(object sender, EventArgs e)
    {
        TriptychBlogSettings TBSettings = new TriptychBlogSettings();
        Title.Text = TBSettings.Title();
        
        try
        {
            WebRequest request = WebRequest.Create("http://triptychstudios.net/triptychblog/help-v.9.0.1.html");
            HttpWebResponse response = (HttpWebResponse)request.GetResponse();
            Stream dataStream = response.GetResponseStream();
            StreamReader reader = new StreamReader(dataStream);
            string strHelp = reader.ReadToEnd();

            litHelp.Text = strHelp;

            reader.Close();
            dataStream.Close();
            response.Close();
        }
        catch (Exception Error)
        {
            litHelp.Text = "The file could not be read: <br />" + Error.Message;
        }

    }
}

namespace Stats
{
    public class Default : System.Web.UI.Page
    {
        protected System.Web.UI.WebControls.Literal Title;
        
        protected void Page_Load(object sender, System.EventArgs e)
        {
            TriptychBlogSettings TBSettings = new TriptychBlogSettings();
            Title.Text = TBSettings.Title();
        }
    }

    public class Browser : System.Web.UI.Page
    {
        protected System.Web.UI.WebControls.DataGrid Stats;

        protected void Page_Load(object sender, System.EventArgs e)
        {
            int width = 200;
            string title = "";// "Browser Usage";

            int[] Data = new int[6];
            int Total;

            OleDbConnection conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb"));
            string MaxVisitor;
            OleDbCommand cmdVisitorNumber;
            Object objMax;

            MaxVisitor = "SELECT Count(*) from TrafficData WHERE Browser = 'IE' AND Spider = 'False'";
            cmdVisitorNumber = new OleDbCommand(MaxVisitor, conNewsData);
            conNewsData.Open();
            objMax = cmdVisitorNumber.ExecuteScalar();
            conNewsData.Close();
            if (objMax != DBNull.Value)
            {
                Data[0] = Convert.ToInt32(objMax);
            }
            else
            {
                Data[0] = 0;
            }

            MaxVisitor = "SELECT Count(*) from TrafficData WHERE Spider = 'False' AND Browser = 'Mozilla' OR Browser = 'Firefox'";
            cmdVisitorNumber = new OleDbCommand(MaxVisitor, conNewsData);
            conNewsData.Open();
            objMax = cmdVisitorNumber.ExecuteScalar();
            conNewsData.Close();
            if (objMax != DBNull.Value)
            {
                Data[1] = Convert.ToInt32(objMax);
            }
            else
            {
                Data[1] = 0;
            }

            MaxVisitor = "SELECT Count(*) from TrafficData WHERE Browser LIKE'%Opera%' AND Spider = 'False'";
            cmdVisitorNumber = new OleDbCommand(MaxVisitor, conNewsData);
            conNewsData.Open();
            objMax = cmdVisitorNumber.ExecuteScalar();
            conNewsData.Close();
            if (objMax != DBNull.Value)
            {
                Data[2] = Convert.ToInt32(objMax);
            }
            else
            {
                Data[2] = 0;
            }

            MaxVisitor = "SELECT Count(*) from TrafficData WHERE Browser LIKE '%Safari%' AND Spider = 'False'";
            cmdVisitorNumber = new OleDbCommand(MaxVisitor, conNewsData);
            conNewsData.Open();
            objMax = cmdVisitorNumber.ExecuteScalar();
            conNewsData.Close();
            if (objMax != DBNull.Value)
            {
                Data[3] = Convert.ToInt32(objMax);
            }
            else
            {
                Data[3] = 0;
            }

            MaxVisitor = "SELECT Count(*) from TrafficData WHERE Spider = 'True'";
            cmdVisitorNumber = new OleDbCommand(MaxVisitor, conNewsData);
            conNewsData.Open();
            objMax = cmdVisitorNumber.ExecuteScalar();
            conNewsData.Close();
            if (objMax != DBNull.Value)
            {
                Data[4] = Convert.ToInt32(objMax);
            }
            else
            {
                Data[4] = 0;
            }

            MaxVisitor = "SELECT MAX(Visitor) from TrafficData";
            cmdVisitorNumber = new OleDbCommand(MaxVisitor, conNewsData);
            conNewsData.Open();
            objMax = cmdVisitorNumber.ExecuteScalar();
            conNewsData.Close();
            if (objMax != DBNull.Value)
            {
                Total = Convert.ToInt32(objMax);
            }
            else
            {
                Total = 0;
            }

            Data[5] = Total - Data[0] - Data[1] - Data[2] - Data[3] - Data[4];

            SolidBrush[] Colors = new SolidBrush[6];

            Colors[0] = new SolidBrush(Color.FromArgb(0, 85, 128));
            Colors[1] = new SolidBrush(Color.FromArgb(0, 168, 255));
            Colors[2] = new SolidBrush(Color.FromArgb(0, 128, 191));
            Colors[3] = new SolidBrush(Color.FromArgb(128, 212, 255));
            Colors[4] = new SolidBrush(Color.FromArgb(102, 102, 102));
            Colors[5] = new SolidBrush(Color.FromArgb(236, 249, 255));

            string[] Legend = new string[6];

            Legend[0] = "Internet Explorer";
            Legend[1] = "Mozilla/FireFox";
            Legend[2] = "Opera";
            Legend[3] = "Safari";
            Legend[4] = "Crawler";
            Legend[5] = "Other";

            Font fontLegend = new Font("Verdana", 10);
            Font fontTitle = new Font("Verdana", 1);

            const int bufferSpace = 12;
            int legendHeight = fontLegend.Height * (Data.Length + 1) + bufferSpace;
            int titleHeight = 0;
            int height = width + legendHeight + titleHeight + bufferSpace;
            int pieHeight = width;

            Rectangle pieRect = new Rectangle(0, titleHeight, width-1, pieHeight);

            //Create a Bitmap instance    
            Bitmap bmpCanvas = new Bitmap(width, height);
            Graphics gfxBrowser = Graphics.FromImage(bmpCanvas);
            gfxBrowser.Clear(Color.White);
            gfxBrowser.SmoothingMode = System.Drawing.Drawing2D.SmoothingMode.AntiAlias;

            //Draw Pie Chart
            float currentDegree = 0.0F;

            SolidBrush blackBrush = new SolidBrush(Color.Black);
            gfxBrowser.FillRectangle(new SolidBrush(Color.White), 0, 0, width, height);

            for (int i = 0; i < Data.Length; i++)
            {
                gfxBrowser.FillPie(Colors[i], pieRect, currentDegree, Convert.ToSingle(Data[i]) / Total * 360);
                currentDegree += Convert.ToSingle(Data[i]) / Total * 360;
            }

            //Draw Legend
            gfxBrowser.DrawRectangle(new Pen(Color.Black, 1), 0, height - legendHeight, 200-1, legendHeight-1);

            for (int j = 0; j < Data.Length; j++)
            {
                gfxBrowser.FillRectangle(Colors[j], 5 + 0, height - legendHeight + fontLegend.Height * j + 5, 10, 10);
                gfxBrowser.DrawRectangle(new Pen(Color.Black), 5 + 0, height - legendHeight + fontLegend.Height * j + 5, 10, 10);
                gfxBrowser.DrawString(Legend[j] + ": " + ((float)Data[j]/(float)Total*100).ToString("f2")+"%", fontLegend, blackBrush, 20 + 0, height - legendHeight + fontLegend.Height * j + 1);
            }

            // display the total
            gfxBrowser.DrawString("Total: " + Convert.ToString(Total), fontLegend, blackBrush, 5 + 0, height - fontLegend.Height - 5);

            // Create the title, centered
            StringFormat stringFormat = new StringFormat();
            stringFormat.Alignment = StringAlignment.Center;
            stringFormat.LineAlignment = StringAlignment.Center;

            gfxBrowser.DrawString(title, fontTitle, new SolidBrush(Color.FromArgb(0, 85, 128)), new Rectangle(0, 0, width, titleHeight), stringFormat);

            Page pgBrowser = Page;
            MemoryStream msPNG = new MemoryStream();
            pgBrowser.Response.ContentType = "image/png";
            bmpCanvas.Save(msPNG, ImageFormat.Png);
            msPNG.WriteTo(pgBrowser.Response.OutputStream);
        }
    }
}

namespace Feed
{
    public class Backup : System.Web.UI.Page
    {
        protected System.Web.UI.WebControls.Repeater Article;
        protected System.Web.UI.WebControls.Repeater Comment;
        protected System.Web.UI.WebControls.Repeater Blogroll;
        protected System.Web.UI.WebControls.Repeater Category;
        protected System.Web.UI.WebControls.Repeater Settings;
        protected System.Web.UI.WebControls.Repeater Theme;
        protected System.Web.UI.WebControls.Literal Timezone;
        protected System.Web.UI.WebControls.Literal UserName;
        protected System.Web.UI.WebControls.Literal Title;
        protected System.Web.UI.WebControls.Literal Generator;

        protected void Page_Load(object sender, System.EventArgs e)
        {
            OleDbConnection conNewsData;
            OleDbCommand cmdSelectDB;
            OleDbDataReader dtrArticleData;

            conNewsData = new OleDbConnection("PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA Source=" + Server.MapPath("../NewsData.mdb"));
            conNewsData.Open();
            cmdSelectDB = new OleDbCommand("Select * From ArticleData", conNewsData);
            dtrArticleData = cmdSelectDB.ExecuteReader();
            Article.DataSource = dtrArticleData;
            Article.DataBind();
            conNewsData.Close();

            conNewsData.Open();
            cmdSelectDB = new OleDbCommand("Select * From CommentData", conNewsData);
            dtrArticleData = cmdSelectDB.ExecuteReader();
            Comment.DataSource = dtrArticleData;
            Comment.DataBind();
            conNewsData.Close();

            XmlDocument xmlConfig = new XmlDocument();

            xmlConfig.Load(Server.MapPath("../Config.xml"));
            XmlNodeList xmlBlogroll = xmlConfig.SelectNodes("config/blogroll");
            Blogroll.DataSource = xmlBlogroll;
            Blogroll.DataBind();

            XmlNodeList xmlCategory = xmlConfig.SelectNodes("config/category");
            Category.DataSource = xmlCategory;
            Category.DataBind();

            XmlNodeList xmlSettings = xmlConfig.SelectNodes("config/settings");
            Settings.DataSource = xmlSettings;
            Settings.DataBind();

            /// Feature Not Yet Supported
            /*XmlNodeList xmlTheme = xmlConfig.SelectNodes("config/theme");
            Theme.DataSource = xmlTheme;
            Theme.DataBind();*/

            XmlNodeList lstConfig = xmlConfig.GetElementsByTagName("settings");
            string strTitle = null;
            string strVersion = null;
            string strTimezone = null;


            foreach (XmlNode NodeConfig in lstConfig)
            {
                XmlElement elmConfig = (XmlElement)NodeConfig;

                strTitle = elmConfig.GetElementsByTagName("title")[0].InnerText;
                strVersion = elmConfig.GetElementsByTagName("version")[0].InnerText;
                strTimezone = elmConfig.GetElementsByTagName("timezone")[0].InnerText;
            }

            FormsIdentity objUserIdentity;
            objUserIdentity = (FormsIdentity)User.Identity;
            UserName.Text = objUserIdentity.Name.ToString();
            Title.Text = strTitle + " Backup";
            Generator.Text = strTitle + " v" + strVersion;
            Timezone.Text = strTimezone;

            System.Random RandNum = new System.Random();
            int intRand = RandNum.Next(99999);

            Response.ContentType = "text/xml";
            Response.AppendHeader("content-disposition", "attachment; filename=" + (strTitle + "_" + DateTime.Now.ToString("MM-d-yy") + "_" + intRand.ToString() + ".xml"));
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
            data = data.Replace("<", "&lt;");
            data = data.Replace(">", "&gt;");

            return data;
        }

        public static string ForURL(object input)
        {
            string data = input.ToString();      // cast the input to a string

            // replace those characters disallowed in XML documents
            data = data.Replace(" ", "%20");
            data = data.Replace("&", "&amp;");

            return data;
        }
    }
}

