<html>
<title>Simple Database-Test for JDBC</title>
<body>

<%@ page import="java.sql.*" isThreadSafe="false" %>
<%@ page import="javax.sql.*" isThreadSafe="false" %>
<%@ page import="javax.naming.*" isThreadSafe="false" %>

<%

    final String jndiName = "java:comp/env/jdbc/mysampledb";
    Connection cn = null;
    Statement  st = null;
    ResultSet  rs = null;
    try
    {
      InitialContext ctxt = new InitialContext();
      DataSource ds = (DataSource) ctxt.lookup(jndiName);
      cn = ds.getConnection();
      st = cn.createStatement();
      rs = st.executeQuery( "select id,name from or_user" );
      ResultSetMetaData rsmd = rs.getMetaData();
      int n = rsmd.getColumnCount();
      out.println( "<table border=1 cellspacing=0><tr>" );
      for( int i=1; i<=n; i++ )    // Achtung: erste Spalte mit 1 statt 0
        out.println( "<th>" + rsmd.getColumnName( i ) + "</th>" );
      while( rs.next() )
      {
        out.println( "</tr><tr>" );
        for( int i=1; i<=n; i++ )  // Achtung: erste Spalte mit 1 statt 0
          out.println( "<td>" + rs.getString( i ) + "</td>" );
      }
      out.println( "</tr></table>" );
    }
    finally
    {
      try { if( null != rs ) rs.close(); } catch( Exception ex ) {}
      try { if( null != st ) st.close(); } catch( Exception ex ) {}
      try { if( null != cn ) cn.close(); } catch( Exception ex ) {}
    }
%>

</body>
</html>

