package javaThingsForTheApp;

import java.sql.*;

public class User {

    private String uname;
    private String passw;

    public User(String uname, String passw) {
        this.uname = uname;
        this.passw = passw;
    }

    public String getUname() {
        return uname;
    }

    public void setUname(String uname) {
        this.uname = uname;
    }

    public String getPassw() {
        return passw;
    }

    public void setPassw(String passw) {
        this.passw = passw;
    }

    @Override
    public String toString() {
        return "User{" +
                "uname='" + uname + '\'' +
                ", passw='" + passw + '\'' +
                '}';
    }
}
