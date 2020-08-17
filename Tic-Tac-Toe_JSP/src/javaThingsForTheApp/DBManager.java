package javaThingsForTheApp;

import java.sql.*;
import java.util.ArrayList;

public class DBManager {

    private Statement stmt;

    public DBManager() {
        connect();
    }

    private void connect() {
        try {
            Class.forName("org.gjt.mm.mysql.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost/labweb", "root", "");
            stmt = con.createStatement();
        } catch(Exception ex) {
            System.out.println("eroare la connect:"+ex.getMessage());
            ex.printStackTrace();
        }
    }

    public User authenticate(String username, String password) {
        ResultSet rs;
        User u = null;
        System.out.println(username+" "+password);
        try {
            rs = stmt.executeQuery("select * from account where uname='"+username+"' and passw='"+password+"'");
            if (rs.next()) {
                u = new User( rs.getString("uname"), rs.getString("passw"));
            }
            rs.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return u;
    }

    public void logUser(String uname){

        try {
            stmt.executeUpdate("insert into loggedin (uname) values (" + "'" + uname + "'" + ")");
        }
         catch (SQLException e) {
            e.printStackTrace();
        }

    }

    public int countUsersLoggedIn()
    {
        try{
            ResultSet resultSet = stmt.executeQuery("select count(*) as nr2 from (select uname, count(*) as nr from loggedin group by uname) as aux");
            if(resultSet.next())
            {
                return resultSet.getInt("nr2");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }

    public ArrayList<Integer> getTable()
    {
        ArrayList<Integer> result = new ArrayList<>();
        try {
            ResultSet resultSet = stmt.executeQuery("select * from gametable");
            if(resultSet.next())
            {
                result.add(resultSet.getInt("0"));
                result.add(resultSet.getInt("1"));
                result.add(resultSet.getInt("2"));
                result.add(resultSet.getInt("3"));
                result.add(resultSet.getInt("4"));
                result.add(resultSet.getInt("5"));
                result.add(resultSet.getInt("6"));
                result.add(resultSet.getInt("7"));
                result.add(resultSet.getInt("8"));

            }

        } catch (SQLException e) {
            e.printStackTrace();
        }
        return result;
    }

    public boolean addMove(Integer poz, Integer player)
    {
        try {
            stmt.executeUpdate("update gametable set " + "`" + poz +"`" + " = " + player);
            return true;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public Integer getPlayer(String playerName)
    {
        try {
            ResultSet resultSet = stmt.executeQuery("select uname from loggedin limit 1");
            if (resultSet.next())
            {
                String uname = resultSet.getString("uname");
                if(uname.equals(playerName))
                    return 1;
                return -1;
            }
            return 0;

        } catch (SQLException e) {
            e.printStackTrace();
            return 0;
        }
    }

    public boolean getTurn(Integer player) {

        ArrayList<Integer> table = this.getTable();
        Integer zeros=0, ones=0, negativeones =0;
        boolean result;
        for (Integer i:table
             ) {
            if(i.equals(0))
                zeros++;
            else if (i.equals(1))
                ones++;
            else negativeones++;

        }

        if(zeros.equals(9))
            return player.equals(1);
            else if(ones.equals(negativeones+1))
                    return player.equals(-1);
                else if(negativeones.equals(ones))
                        return player.equals(1);

                return false;

    }
    public void cleanUsers()
    {
        try {
            stmt.executeUpdate("delete from loggedin");
//            stmt.executeUpdate("delete from gametable");
//            stmt.executeUpdate("insert into gametable values (0,0,0,0,0,0,0,0,0)");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void cleanTable()
    {
        try {
           // stmt.executeUpdate("delete from loggedin");
            stmt.executeUpdate("delete from gametable");
            stmt.executeUpdate("insert into gametable values (0,0,0,0,0,0,0,0,0)");
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
