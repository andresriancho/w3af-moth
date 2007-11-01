<% 
    Response.AddHeader "testing", Request.QueryString("testing")
    Response.Write "This is a simple rs test"
%>
