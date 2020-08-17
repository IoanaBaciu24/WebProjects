package webapp;

import javaThingsForTheApp.DBManager;
import javaThingsForTheApp.User;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.io.PrintWriter;

@WebServlet(name = "webapp.login")
public class login extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        String uname = request.getParameter("uname");
        String passw = request.getParameter("passw");
        DBManager dbManager = new DBManager();
        User user = dbManager.authenticate(uname,passw);


        RequestDispatcher requestDispatcher = null;
        //todo pune si conditia sa nu fie mai mult de 2
        if(user!=null && dbManager.countUsersLoggedIn() < 2)
        {
            requestDispatcher = request.getRequestDispatcher("/registrated.jsp");
            HttpSession httpSession =request.getSession();
            httpSession.setAttribute("user", user);
            dbManager.logUser(uname);
            //dbManager.countUsersLoggedIn();

        }
        else {
            requestDispatcher = request.getRequestDispatcher("/err.jsp");
        }
        requestDispatcher.forward(request, response);


    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

    }
}
