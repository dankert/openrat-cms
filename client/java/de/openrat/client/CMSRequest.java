/*
OpenRat Java-Client
Copyright (C) 2009 Jan Dankert
 
This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Library General Public
License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Library General Public License for more details.

You should have received a copy of the GNU Library General Public
License along with this library; if not, write to the
Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
Boston, MA  02110-1301, USA.

 */
package de.openrat.client;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.io.StringReader;
import java.io.UnsupportedEncodingException;
import java.net.InetSocketAddress;
import java.net.Socket;
import java.net.SocketAddress;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;
import java.util.Map.Entry;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;

import org.w3c.dom.Document;
import org.xml.sax.InputSource;
import org.xml.sax.SAXException;

/**
 * API-Request to the OpenRat Content Management System. <br>
 * <br>
 * The call to the CMS server is done via a (non-SSL) HTTP connection.<br>
 * <br>
 * Before a call you are able to set some key/value-pairs as parameters. After calling the CMS a
 * DOM-document is returned, which contains the server response.<br>
 * Example <br>
 * 
 * <pre>
 * CMSRequest request = new CMSRequest(&quot;your.openrat.example.com&quot;);
 * //prints tracing information to stdout.
 * request.trace = true;
 * try {
 *     request.parameter.put(&quot;action&quot;, &quot;index&quot;);
 *     request.parameter.put(&quot;subaction&quot;, &quot;showlogin&quot;); // login page
 *     request.parameter.put(&quot;...&quot;, &quot;...&quot;);
 *     Document response = request.call();
 *     // now traverse through the dom tree and get your information.
 * }
 * catch (IOException e) {
 *     // your error handling.
 * }
 * </pre>
 * 
 * @author Jan Dankert
 */
public class CMSRequest {

    // some constants...
    private static final String CHARSET_UTF8 = "UTF-8";
    private static final String HTTP_GET = "GET";
    private static final String HTTP_POST = "POST";

    /**
     * if <code>true</code>, Tracing-Output will be logged to stdout. Default: <code>false</code>.
     */
    // this is public, for easier use.
    public boolean trace = false;

    /**
     * HTTP-method, must be "GET" or "POST", default: "GET".
     */
    private String method = HTTP_GET;

    /**
     * Parameter map.
     */
    private Map<String, String> parameter = new HashMap<String, String>();

    private String serverPath;
    private String serverHost;
    private int serverPort;

    private String proxyHostname;
    private int proxyPort;
    private SocketAddress socketAddress;

    private String cookieName;
    private String cookieValue;

    /**
     * Setting a HTTP-Cookie.
     * 
     * @param name name
     * @param value value
     */
    public void setCookie(String name, String value) {

        this.cookieName = this.urlEncode(name);
        this.cookieValue = this.urlEncode(value);
    }

    /**
     * URL-Encoder.
     * 
     * @param value
     * @return url-encoded value
     */
    private String urlEncode(String value) {

        try {
            return URLEncoder.encode(value, CHARSET_UTF8);
        }
        catch (UnsupportedEncodingException e) {
            // maybe... this would be strange
            throw new IllegalStateException(CHARSET_UTF8 + " ist not supported by this VM");
        }
    }

    /**
     * Setting a HTTP-Proxy.
     * 
     * @param host hostname
     * @param port port
     */
    public void setProxy(String host, int port) {

        this.proxyHostname = host;
        this.proxyPort = port;
    }

    /**
     * Set the HTTP Method. Default is "GET".
     * 
     * @param method HTTP-method
     */
    public void setMethod(String method) {

        if (!HTTP_GET.equalsIgnoreCase(method) && !HTTP_POST.equalsIgnoreCase(method))
            throw new IllegalArgumentException("Method must be '" + HTTP_POST + "' or '" + HTTP_GET
                    + "'.");

        this.method = method.toUpperCase();
    }

    /**
     * Clear parameter values.
     */
    public void clearParameters() {

        parameter.clear();
    }

    /**
     * Setting a parameter value. <strong>DO NOT url-encode your values</strong> as this is done
     * automatically inside this method!
     * 
     * @param paramName name
     * @param paramValue value
     */
    public void setParameter(String paramName, String paramValue) {

        if (paramName == null || paramValue == null || "" == paramName)
            throw new IllegalArgumentException("parameter name and value must have values");

        parameter.put(paramName, paramValue);
    }

    /**
     * Constructs a CMS-Request to the specified server.<br>
     * Server-Path is "/", Server-Port is 80.
     * 
     * @param host hostname
     */
    public CMSRequest(String host) {

        super();
        this.serverHost = host;
        this.serverPath = "/";
        this.serverPort = 80;
    }

    /**
     * Constructs a CMS-Request to the specified server/path.<br>
     * Server-Port is 80.
     * 
     * @param host hostname
     * @param path path
     */
    public CMSRequest(String host, String path) {

        super();
        this.serverHost = host;
        this.serverPath = path;
        this.serverPort = 80;
    }

    /**
     * Constructs a CMS-Request to the specified server/path/port.
     * 
     * @param host hostname
     * @param path path
     * @param port port-number
     */
    public CMSRequest(String host, String path, int port) {

        super();
        this.serverHost = host;
        this.serverPath = path;
        this.serverPort = port;
    }

    /**
     * Sends a request to the openrat-server and parses the response into a DOM tree document.
     * 
     * @return server response as a DOM tree
     * @throws IOException if server is unrechable or responds non-wellformed XML
     */
    public Document performRequest() throws IOException {

        final Socket socket = new Socket();

        try {

            final boolean useProxy = this.proxyHostname != null;
            final boolean useCookie = this.cookieName != null;

            if (serverPath == null)
                this.serverPath = "/";
            if (!serverPath.startsWith("/"))
                this.serverPath = "/" + this.serverPath;

            // When a client uses a proxy, it typically sends all requests to that proxy, instead
            // of to the servers in the URLs. Requests to a proxy differ from normal requests in one
            // way: in the first line, they use the complete URL of the resource being requested,
            // instead of just the path.
            if (useProxy) {
                socketAddress = new InetSocketAddress(this.proxyHostname, this.proxyPort);
            } else {
                socketAddress = new InetSocketAddress(this.serverHost, serverPort);
            }

            socket.setKeepAlive(false);
            socket.setReuseAddress(false);
            socket.connect(socketAddress, 5000);

            final StringBuffer header = new StringBuffer();

            final StringBuffer parameterList = new StringBuffer();

            for (Entry<String, String> entry : this.parameter.entrySet()) {
                if (parameterList.length() > 0)
                    parameterList.append("&");
                parameterList.append(this.urlEncode(entry.getKey()));
                parameterList.append("=");
                parameterList.append(this.urlEncode(entry.getValue()));
            }

            String httpUrl = this.serverPath;

            if (useProxy)
                // See RFC 2616 Section 5.1.2 "Request-URI"
                // "The absolute URI form is REQUIRED when the request is being made to a proxy"
                httpUrl = "http://" + this.serverHost + httpUrl;

            if (HTTP_GET.equals(this.method))
                httpUrl = httpUrl + "?" + parameterList;

            // using HTTP/1.0 as this is supported by all HTTP-servers and proxys.
            // We have no need for HTTP/1.1 at the moment.
            header.append(this.method + " " + httpUrl + " HTTP/1.0\n");

            // Setting the HTTP Header
            header.append("Host: " + this.serverHost + "\n");
            header.append("User-Agent: Mozilla/5.0; compatible (OpenRat java-client)\n");
            header.append("Accept: application/xml\n");
            header.append("Accept-Language: " + Locale.getDefault().getLanguage() + "\n");
            header.append("Accept-Charset: utf-8\n");
            header.append("Connection: close\n");
            if (useCookie)
                header.append("Cookie: " + cookieName + "=" + cookieValue + "\n");

            if (HTTP_POST.equals(this.method)) {
                header.append("Content-Type: application/x-www-form-urlencoded" + "\n");
                header.append("Content-Length: " + parameterList.length() + "\n");
            }

            header.append("\n");

            if (HTTP_POST.equals(this.method))
                header.append(parameterList);

            if (this.trace)
                System.out.println("--- request ---");
            if (this.trace)
                System.out.println(header.toString());

            final PrintWriter printWriter = new PrintWriter(socket.getOutputStream(), true);
            printWriter.write(header.toString());
            printWriter.flush();

            final InputStream inputStream = socket.getInputStream();
            final int available = inputStream.available();

            final BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(socket
                    .getInputStream()));

            final String httpResponse = bufferedReader.readLine().trim();
            final String httpRetCode = httpResponse.substring(9, 12);

            if (this.trace)
                System.out.println("--- response ---");
            if (this.trace)
                System.out.println(httpResponse);

            // Check if we got the status 200=OK.
            if (!httpRetCode.equals("200")) {

                // non-200-status seems to be an error.
                throw new IOException("No HTTP 200: Status=" + httpRetCode + " (" + httpResponse
                        + ")");
            }

            while (true) {

                String responseHeader = bufferedReader.readLine().trim();

                if (responseHeader.equals(""))
                    break;

                if (this.trace)
                    System.out.println(responseHeader);
            }

            StringBuffer response = new StringBuffer();
            while (bufferedReader.ready()) {

                response.append(bufferedReader.readLine() + "\n");
            }
            socket.close();

            if (this.trace)
                System.out.println("--- response body ---");
            if (this.trace)
                System.out.println(response + "\n\n\n");

            final DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
            final DocumentBuilder builder = factory.newDocumentBuilder();
            final Document document = builder.parse(new InputSource(new StringReader(response
                    .toString())));

            return document;

        }
        catch (ParserConfigurationException e) {
            throw new IOException("XML-Parser-Configuration invalid" + e.getMessage());
        }
        catch (SAXException e) {
            throw new IOException("Server did not return a valid XML-document" + e.getMessage());
        }
        finally {
            try {
                socket.close(); // Clean up the socket.
            }
            catch (IOException e) {
                // We have done our very best.
            }
        }
    }
}
