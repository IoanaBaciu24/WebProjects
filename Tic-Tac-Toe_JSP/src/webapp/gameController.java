package webapp;

import javaThingsForTheApp.DBManager;
import javaThingsForTheApp.game;
import org.json.simple.JSONObject;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;

@WebServlet(name = "gameController")
public class gameController extends HttpServlet {

    private DBManager dbManager = new DBManager();
    private game game= new game();
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        //DBManager dbManager = new DBManager();
            String action = request.getParameter("action");
            if(action!=null && action.equals("getLogged"))
            {
                response.setContentType("application/json");
                int i = dbManager.countUsersLoggedIn();
                JSONObject jsonObject = new JSONObject();
                jsonObject.put("numberOfLoggedInUsers", i);

                PrintWriter out = new PrintWriter(response.getOutputStream());
                out.println(jsonObject.toJSONString());
                out.flush();

            }
            if(action!=null && action.equals("placeMove")){
                String position = request.getParameter("position");
                String player = request.getParameter("player");
                boolean b = game.addMove(Integer.parseInt(position), Integer.parseInt(player));
                JSONObject jsonObject = new JSONObject();
                System.out.println(b);
                jsonObject.put("returnValue", b);

                PrintWriter out = new PrintWriter(response.getOutputStream());
                out.println(jsonObject.toJSONString());
                out.flush();

            }
        if(action!=null && action.equals("getTable")){
            ArrayList<Integer> moves = game.getMoves();
            System.out.println(moves);
            JSONObject jsonObject = new JSONObject();
            jsonObject.put("returnValue", moves);

            PrintWriter out = new PrintWriter(response.getOutputStream());
            out.println(jsonObject.toJSONString());
            out.flush();
        }

        if(action!=null &&action.equals("getPlayer"))
        {
            String name = request.getParameter("uname");
            Integer player = dbManager.getPlayer(name);

            JSONObject jsonObject = new JSONObject();
            jsonObject.put("returnValue", player);

            PrintWriter out = new PrintWriter(response.getOutputStream());
            out.println(jsonObject.toJSONString());
            out.flush();
        }

        if(action!=null && action.equals("getTurn"))
        {
            Integer player = Integer.parseInt(request.getParameter("player"));
            boolean turn = dbManager.getTurn(player);

            JSONObject jsonObject = new JSONObject();
            jsonObject.put("returnValue", turn);

            PrintWriter out = new PrintWriter(response.getOutputStream());
            out.println(jsonObject.toJSONString());
            out.flush();
        }
        if(action!=null && action.equals("getResult"))
        {
            boolean tie = game.isTie();
            Integer won = game.isWon();

            JSONObject jsonObject = new JSONObject();
            jsonObject.put("won", won);
            jsonObject.put("tie", tie);

            PrintWriter out = new PrintWriter(response.getOutputStream());
            out.println(jsonObject.toJSONString());
            out.flush();

        }

        if(action!=null && action.equals("clean"))
        {
            if(request.getParameter("whomst").equals("users"))
            dbManager.cleanUsers();
            else dbManager.cleanTable();
        }

    }
}
