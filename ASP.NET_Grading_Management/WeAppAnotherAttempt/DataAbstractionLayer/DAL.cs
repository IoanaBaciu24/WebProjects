using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using WebApplication2.Models;

namespace WebApplication2.DataAbstractionLayer
{
    public class DAL
    {
        public Student connectStudent(String uname, String passw)
        {

            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=db1;";
            List<Student> slist = new List<Student>();

            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from student where id=" + "'" + uname + "'" + " and passw = " + "'" + passw + "'";
                MySqlDataReader myreader = cmd.ExecuteReader();

                while (myreader.Read())
                {
                    Student student = new Student();
                    student.id = myreader.GetString("id");
                    student.name = myreader.GetString("name");
                    student.passw = myreader.GetString("passw");
                    student.group_id = myreader.GetInt32("group_id");

                    return student;

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }


            return null;
        }


        public Teacher connectTeacher(String uname, String passw)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;

            myConnectionString = "server=localhost;uid=root;pwd=;database=db1;";
            List<Student> slist = new List<Student>();

            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from teacher where id=" + "'" + uname + "'" + " and passw = " + "'" + passw + "'";
                MySqlDataReader myreader = cmd.ExecuteReader();

                while (myreader.Read())
                {
                    Teacher student = new Teacher();
                    student.id = myreader.GetString("id");
                    student.name = myreader.GetString("name");
                    student.passw = myreader.GetString("passw");

                    return student;

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }


            return null;
        }

        public List<Grade> getGradesOfStudent(string student_id)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;
            List<Grade> result = new List<Grade>();
            myConnectionString = "server=localhost;uid=root;pwd=;database=db1;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from grade where studentID=" + "'" + student_id + "'";
                MySqlDataReader myreader = cmd.ExecuteReader();

                while (myreader.Read())
                {
                    Grade grade = new Grade();
                    grade.id = myreader.GetInt32("id");
                    grade.student_id = myreader.GetString("studentID");
                    grade.teacher_id = myreader.GetString("teacherID");
                    grade.grade_value = myreader.GetInt32("grade_value");
                    grade.course = myreader.GetString("course");

                    result.Add(grade);

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }

            return result;
        }

        public List<Student> getLoazeOfGroup(int group_id) {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;
            List<Student> result = new List<Student>();
            myConnectionString = "server=localhost;uid=root;pwd=;database=db1;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from student where group_id=" + group_id;
                MySqlDataReader myreader = cmd.ExecuteReader();

                while (myreader.Read())
                {
                    Student student = new Student();
                    student.id = myreader.GetString("id");
                    student.name = myreader.GetString("name");
                    student.passw = myreader.GetString("passw");
                    student.group_id = myreader.GetInt32("group_id");

                    result.Add(student);

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }

            return result;
        }

        public List<Grade> getGradesFromProf(string prof_id)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;
            List<Grade> result = new List<Grade>();
            myConnectionString = "server=localhost;uid=root;pwd=;database=db1;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "select * from grade where teacherID=" + "'" + prof_id + "'";
                MySqlDataReader myreader = cmd.ExecuteReader();

                while (myreader.Read())
                {
                    Grade grade = new Grade();
                    grade.id = myreader.GetInt32("id");
                    grade.student_id = myreader.GetString("studentID");
                    grade.teacher_id = myreader.GetString("teacherID");
                    grade.grade_value = myreader.GetInt32("grade_value");
                    grade.course = myreader.GetString("course");

                    result.Add(grade);

                }
                myreader.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }

            return result;
        }

        public void addGrade(Grade grade)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;
            myConnectionString = "server=localhost;uid=root;pwd=;database=db1;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "insert into grade(studentID, teacherID, grade_value, course) values (" + "'" + grade.student_id + "'," + "'" + grade.teacher_id + "'," + grade.grade_value + ',' + "'" + grade.course + "')";
               cmd.ExecuteNonQuery();

                conn.Close();            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }

        }

        public void deleteGrade(int grade_id)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;
            myConnectionString = "server=localhost;uid=root;pwd=;database=db1;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "delete from grade where id=" + grade_id;
                cmd.ExecuteNonQuery();

                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }
        }

        public void updateGrade(Grade grade)
        {
            MySql.Data.MySqlClient.MySqlConnection conn;
            string myConnectionString;
            myConnectionString = "server=localhost;uid=root;pwd=;database=db1;";
            try
            {
                conn = new MySql.Data.MySqlClient.MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                MySqlCommand cmd = new MySqlCommand();
                cmd.Connection = conn;
                cmd.CommandText = "update grade set studentID='" +grade.student_id +"',grade_value="+ grade.grade_value + ", course='"+ grade.course+ "' where id=" + grade.id ;
                cmd.ExecuteNonQuery();

                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                Console.Write(ex.Message);
            }
        }
    }
}