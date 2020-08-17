using famFeud.Models;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace famFeud.DAbstrL
{
    public class DAL
    {
        public Person connectBoye(string uname, int secNo)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=somedb4;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from person where user=" + "'" + uname + "'" + " and secretNr = " + secNo ;
                MySqlDataReader myreader = cmd.ExecuteReader();

                while (myreader.Read())
                {
                    Person user = new Person();


                    user.id = myreader.GetInt32("id");
                    user.user = myreader.GetString("user");
                    user.secretNr = myreader.GetInt32("secretNr");
                    user.name = myreader.GetString("name");
                    user.picFile = myreader.GetString("picFile");
                    user.familyMembs = myreader.GetString("famMembs");

                    return user;

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }


            return null;
        }

        public Person getUserById(int userId)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=somedb4;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from person where id=" + "'" + userId + "'";
                MySqlDataReader myreader = cmd.ExecuteReader();

                while (myreader.Read())
                {
                    Person user = new Person();


                    user.id = myreader.GetInt32("id");
                    user.user = myreader.GetString("user");
                    user.secretNr = myreader.GetInt32("secretNr");
                    user.name = myreader.GetString("name");
                    user.picFile = myreader.GetString("picFile");
                    user.familyMembs = myreader.GetString("famMembs");

                    return user;

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }


            return null;
        }

        public List<int> getFamilyIds(String fam)
        {
            string[] ids = fam.Split(',');
            List<int> res = new List<int>();
            foreach (var id in ids)
            {
                res.Add(Int32.Parse(id));
            }

            return res;
        }



        public List<String> getFamMembers(int uid)
        {
            Person user = getUserById(uid);
            List<int> ids = getFamilyIds(user.familyMembs);
            List<String> result = new List<string>();

            foreach (int id in ids)
            {
                Person p = getUserById(id);
                result.Add(p.name);
            }

            return result;
        }

        private List<int> getFirstDegFrIdsOfUser(int userID)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;
            List<int> result = new List<int>();

            myConnectionString = "server=localhost;uid=root;pwd=;database=somedb4;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from friend where friendA=" + userID + " or friendB=" + userID;
                MySqlDataReader myreader = cmd.ExecuteReader();
                while (myreader.Read())
                {
                    Person user = new Person();

                    int a = myreader.GetInt32("friendA");
                    int b = myreader.GetInt32("friendB");

                    if (a == userID)
                        result.Add(b);
                    else
                        result.Add(a);


                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }


            return result;
        }

        private HashSet<int> getSecDegF(int userId)
        {

            List<int> fdeg = getFirstDegFrIdsOfUser(userId);
            HashSet<int> res = new HashSet<int>();
            foreach (int id in fdeg)
            {
                List<int> aux = getFirstDegFrIdsOfUser(id);
                foreach(int id2 in aux)
                {
                    res.Add(id2);
                }
            }

            return res;
        }

        public HashSet<String> getNamesOfFDFr(int userId)
        {
            List<int> ids = getFirstDegFrIdsOfUser(userId);
            HashSet<String> result = new HashSet<String>();
            foreach (int id in ids)
            {
                Person p = getUserById(id);
                result.Add(p.name);
            }

            return result;
        }

        public List<String> getNamesOfSDFr(int userId)
        {
            HashSet<int> frs = getSecDegF(userId);
            List<String> result = new List<string>();
            foreach (int id in frs)
            {
                Person p = getUserById(id);
                result.Add(p.name);
            }

            return result;
        }

        private HashSet<int> getTrDegF(int userId)
        {
            HashSet<int> fdeg = getSecDegF(userId);
            HashSet<int> res = new HashSet<int>();
            foreach (int id in fdeg)
            {
                List<int> aux = getFirstDegFrIdsOfUser(id);
                foreach (int id2 in aux)
                {
                    res.Add(id2);
                }
            }
            //res.Except(new HashSet<int>(getFirstDegFrIdsOfUser(userId));
            var miau = res.Except(getFirstDegFrIdsOfUser(userId));
            HashSet<int> res2 = new HashSet<int>();
            foreach (int i in miau)
            {
                res2.Add(i);
            }
            return res2;
        }


        public List<String> getNamesOfTRFr(int userId)
        {
            HashSet<int> frs = getTrDegF(userId);
            List<String> result = new List<string>();
            foreach (int id in frs)
            {
                Person p = getUserById(id);
                result.Add(p.name);
            }

            return result;
        }

        public void deleteFriendship(int fa, int fb)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;
            myConnectionString = "server=localhost;uid=root;pwd=;database=somedb4;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                //cmd.CommandText = "insert into assets(id, userId, name, description,value) values(" + mid + ", " + a.userId + ", '" + a.name + "', '" + a.description + "', " + a.value + ")";
                cmd.CommandText = "delete from friend where friendA=" + fa + " and friendB=" + fb;
                cmd.ExecuteNonQuery();

                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }
        }

        public void deleteDujmani(int dujmanId, String famStr)
        {
            List<int> famids = getFamilyIds(famStr);
            foreach (int id in famids)
            {
                deleteFriendship(id, dujmanId);
                deleteFriendship(dujmanId, id);
            }

        }
    }
}