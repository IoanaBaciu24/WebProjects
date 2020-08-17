package javaThingsForTheApp;

import java.util.ArrayList;

public class game {

    ArrayList<Integer> moves;

    DBManager dbManager;

    public game()
    {
        dbManager = new DBManager();
        moves = new ArrayList<>();
        for (int i=0;i<9;i++)
        {
            moves.add(0);
        }
    }

    public boolean addMove(Integer index, Integer player)
    {
        if(moves.get(index) == 0)
        {
            //moves.set(index, player);
            return dbManager.addMove(index, player);
            //return true;
        }
        return false;
    }

    public Integer isWon()
    {
        moves = dbManager.getTable();
        for(int i=0;i<9;i+=3)
        {
            if(moves.get(i).equals(moves.get(i+1)) && moves.get(i+1).equals(moves.get(i+2)))
                return moves.get(i);
        }

        for (int i=0;i<3;i++)
        {
            if(moves.get(i).equals(moves.get(i+3)) && moves.get(i+3).equals(moves.get(i+6)))
                return moves.get(i);
        }

        if(moves.get(0).equals(moves.get(4)) && moves.get(4).equals(moves.get(8)))
            return moves.get(0);
        if(moves.get(2).equals(moves.get(4)) && moves.get(4).equals(moves.get(6)))
            return moves.get(2);

        return 0;
    }

    public ArrayList<Integer> getMoves() {
        moves = dbManager.getTable();
        return moves;
    }

    public boolean isTie()
    {
        moves = dbManager.getTable();
        if(isWon().equals(0))
        {
            int zeros = 0;
            for (Integer i:moves) {
                if(i.equals(0))
                    return false;
                     }
            return true;
        }
        return false;


}}
