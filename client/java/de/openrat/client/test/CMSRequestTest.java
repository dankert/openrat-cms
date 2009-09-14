package de.openrat.client.test;

import java.io.IOException;

import javax.xml.xpath.XPath;
import javax.xml.xpath.XPathConstants;
import javax.xml.xpath.XPathExpression;
import javax.xml.xpath.XPathExpressionException;
import javax.xml.xpath.XPathFactory;

import junit.framework.TestCase;

import org.w3c.dom.Document;
import org.w3c.dom.NodeList;

import de.openrat.client.CMSRequest;

/**
 * @author Jan Dankert
 */
public class CMSRequestTest extends TestCase {

    /**
     */
    public void testRequest() {

        // Call the DEMO-Server of OpenRat.
        CMSRequest request = new CMSRequest("demo.openrat.de", "", 80);

        // prints tracing information to stdout.
        request.trace = true;

        // setting a HTTP proxy
        request.setProxy("proxy.somewhere.example", 8080);

        // Now we do some example requests to the openrat server.
        try {
            // requesting the login page
            request.setParameter("action", "index");
            request.setParameter("subaction", "showlogin");
            Document document = request.performRequest();

            // Evaluating the session id.
            String sessionName = this.getText(document, "/server/session/name");
            String sessionId = this.getText(document, "/server/session/id");
            request.setCookie(sessionName, sessionId);

            // lets try login with a wrong password
            request.clearParameters();
            request.setMethod("POST");
            request.setParameter("action", "index");
            request.setParameter("subaction", "login");
            request.setParameter("login_name", "admin");
            request.setParameter("login_password", "wrongpassword"); // forcing an login error
            request.setParameter("dbid", "db1");

            document = request.performRequest(); // will answer with an error element, see stdout.
            // we are NOT logged in now.

            // requesting a page which is only available for authenticated users
            request.setMethod("get");
            request.clearParameters();
            request.setParameter("action", "index");
            request.setParameter("subaction", "projectmenu");

            try {
                document = request.performRequest();
                fail();
            }
            catch (IOException e) {
                // should crash with HTTP-status=403, as we are NOT logged in.
            }

            // requesting a unknown action, the server should throw an error
            request.clearParameters();
            request.setParameter("action", "index");
            request.setParameter("subaction", "didntknow");

            try {
                document = request.performRequest();
                fail();
            }
            catch (IOException e) {
                // should crash with HTTP-status=501, as the subaction does not exist.
            }

            // OK, lets try a real login now.
            request.setMethod("POST");
            request.clearParameters();
            request.setParameter("action", "index");
            request.setParameter("subaction", "login");
            request.setParameter("login_name", "admin");
            request.setParameter("login_password", "admin");
            request.setParameter("dbid", "db1");

            document = request.performRequest();

            // lets see, what projects are available.
            request.setMethod("get");
            request.clearParameters();
            request.setParameter("action", "index");
            request.setParameter("subaction", "projectmenu");

            document = request.performRequest();

            // Access the project names via XPath
            NodeList nl = this.getNodeSet(document, "/server/projects/entry/name");
            for (int i = 0; i < nl.getLength(); i++) {
                System.out.println("Project name: " + nl.item(i).getTextContent());
            }

            // list all users
            request.clearParameters();
            request.setParameter("action", "user");
            request.setParameter("subaction", "listing");

            document = request.performRequest();

            // lets see the rights of the folder with id 1
            request.clearParameters();
            request.setParameter("action", "folder");
            request.setParameter("subaction", "rights");
            request.setParameter("id", "1");

            document = request.performRequest();

            // lets see the contents of the folder with id 1
            request.clearParameters();
            request.setParameter("action", "folder");
            request.setParameter("subaction", "show");
            request.setParameter("id", "1");

            document = request.performRequest();

            // Access the object names via XPath
            nl = this.getNodeSet(document, "/server/object/entry/name");
            for (int i = 0; i < nl.getLength(); i++) {
                System.out.println("Object name: " + nl.item(i).getTextContent());
            }
        }
        catch (IOException e) {

            e.printStackTrace();
            fail();
        }
    }

    private String getText(Document document, String xpath) throws IOException {

        XPath xPath = XPathFactory.newInstance().newXPath();

        try {
            XPathExpression xPathExpression = xPath.compile(xpath);
            return (String) xPathExpression.evaluate(document, XPathConstants.STRING);
        }
        catch (XPathExpressionException e) {
            throw new IOException(e.getMessage());
        }
    }

    private NodeList getNodeSet(Document document, String xpath) throws IOException {

        XPath xPath = XPathFactory.newInstance().newXPath();

        try {
            XPathExpression xPathExpression = xPath.compile(xpath);
            return (NodeList) xPathExpression.evaluate(document, XPathConstants.NODESET);
        }
        catch (XPathExpressionException e) {
            throw new IOException(e.getMessage());
        }
    }
}
