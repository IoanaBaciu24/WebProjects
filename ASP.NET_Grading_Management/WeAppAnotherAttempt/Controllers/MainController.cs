using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using WebApplication2.DataAbstractionLayer;
using WebApplication2.Models;

namespace WebApplication2.Controllers
{
    public class MainController : Controller
    {
        // GET: Main
        public ActionResult Index()
        {
            FileInfo fi = new FileInfo(Server.MapPath("~/Web.config"));
            fi.LastWriteTime = DateTime.Now;
            return View("StartView");
        }

        public ActionResult LoginStudent()
        {
            Console.Write("got here");
            return View("LoginStudent");
        }

        public ActionResult LoginTeacher()
        {
            Console.Write("got here");
            Console.Write("another message");
            return View("LoginTeacher");
        }

        public ActionResult CheckLoginStud()
        {
            string uname = Request.Params["id"];
            string passw = Request.Params["passw"];
            Console.Write("uname");
            Console.Write("passw");

            DAL dal = new DAL();
            Student stud = dal.connectStudent(uname, passw);
            if (stud != null)
            {

                Session["studentid"] = stud.id;
                Session["studentgr"] = stud.group_id;
                Session["studentname"] = stud.name;
                Session["studentpass"] = stud.passw;

                return View("StudentPage");
            }
            return View("StartView");
        }

        public ActionResult CheckLoginTeacher()
        {
            string uname = Request.Params["id"];
            string passw = Request.Params["passw"];
            Console.Write("uname");
            Console.Write("passw");

            DAL dal = new DAL();
            Teacher teacher = dal.connectTeacher(uname, passw);
            if (teacher != null)
            {

                Session["teacherid"] = teacher.id;
                Session["teachername"] = teacher.name;
                Session["teacherpass"] = teacher.passw;

                return View("TeacherPage");
            }
            return View("StartView");
        }

        public string getGradesOfStudent()
        {
            string student_id = Session["studentid"].ToString();
            string result = "<table id=\"tbl\"><tr><th> id </th><th> teacher id </th><th> given mark </th><th> course </th></tr> ";
            DAL dal = new DAL();
            List<Grade> grades = dal.getGradesOfStudent(student_id);

            foreach (Grade grade in grades)
            {
                result += "<tr>";
                result += "<td>" + grade.id + "</td>";
                result += "<td>" + grade.teacher_id + "</td>";
                result += "<td>" + grade.grade_value + "</td>";
                result += "<td>" + grade.course + "</td>";
                result += "</tr>";

            }

            result += "</table>";

            return result;
        }


        public List<Student> getLoazeOfGroup()
        {

            int group_id = Int32.Parse(Request.QueryString["group_id"]);
            DAL dal = new DAL();
            List<Student> students =  dal.getLoazeOfGroup(group_id);
            return students;

        }


        public int getNoPagesOfGroup()
        {
            int loaze = getLoazeOfGroup().Count;
            int res = loaze/4;
            if (loaze % 4 != 0)
                res++;
            return res;
        }

        public string getPageOfLoaze() {

            string result= "<table id = \"tbl1\" class = \"tbl\"><tr><th>Student ID</th><th>Student Name</th><th>Group</th></tr>";
            int page = Int32.Parse(Request.QueryString["page"]);
            page--;
            List<Student> loaze = getLoazeOfGroup();
            int start = page * 4, finish = Math.Min(start + 3, loaze.Count-1);

            for (int i = start; i <= finish; i++)
            {
                result += "<tr>" +"<td>" +loaze[i].id +"</td>" + "<td>" + loaze[i].name + "</td>" + "<td>" + loaze[i].group_id + "</td>" + "</tr>";
            }

            result += "</table>";

            return result;

        }

        public string getListOfGrades()
        {

            string result = "<table id = \"tbl2\" class = \"tbl\"><tr><th>ID</th><th>Student ID</th><th>Grade Value</th><th>Course</th></tr>";

            DAL dal = new DAL();

            List<Grade> grades = dal.getGradesFromProf(Session["teacherid"].ToString());

            for (int i = 0; i < grades.Count; i++)
            {
                result += "<tr>" + "<td>" + grades[i].id + "</td>" + "<td>" + grades[i].student_id + "</td>" + "<td>" + grades[i].grade_value + "</td>" + "<td>" +grades[i].course+ "</td>" + "</tr>";
            }

            result += "</table>";

            return result;

        }

        public void addGrade()
        {
            Grade grade = new Grade();


            grade.course = Request.Params["course"];
            grade.grade_value = Int32.Parse(Request.Params["mark"]);
            grade.student_id = Request.Params["stid"];
            grade.teacher_id = Session["teacherid"].ToString();

            DAL dal = new DAL();
            dal.addGrade(grade);
        }

        public void deleteGrade() {
            int id = Int32.Parse(Request.Params["grid"].ToString());

            DAL dal = new DAL();
            dal.deleteGrade(id);
        }

        public void updateGrade()
        {
            int id = Int32.Parse(Request.Params["grid"].ToString());

            DAL dal = new DAL();
            Grade grade = new Grade();

            grade.id = Int32.Parse(Request.Params["grid"].ToString()); 
            grade.course = Request.Params["course"];
            grade.grade_value = Int32.Parse(Request.Params["mark"]);
            grade.student_id = Request.Params["stid"];
            grade.teacher_id = Session["teacherid"].ToString();

            dal.updateGrade(grade);

        }

        public void logOut()
        {
            Session.Abandon();
            Session.Clear();
           // string a = Session["studentid"].ToString();
          //  Console.Write();

        }
    }
}