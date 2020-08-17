using famFeud.DAbstrL;
using famFeud.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace famFeud.Controllers
{
    public class MainController : Controller
    {
        // GET: Main
        public ActionResult Index()
        {
            return View("Login");
        }


        public ActionResult CheckLogin()
        {

            string uname = Request.Params["uname"];
            int passw = Int32.Parse(Request.Params["secretNo"]);

            DAL dal = new DAL();
            Person user = dal.connectBoye(uname, passw);
            if (user != null)
            {
                Session["uname"] = user.user;
                Session["id"] = user.id;
                Session["picFile"] = user.picFile;
                Session["familyMembs"] = user.familyMembs;
       
                return View("MainPG");
                //return "yay";
            }

            return View("Error");
            //return "nay";

        }

        public String getPic()
        {
            String loc = Session["picFile"].ToString();

            return "<img src=\"" + loc + "\" width = '300'>";
        }

        public String getFamily()
        {
            int userId = Int32.Parse(Session["id"].ToString());
            DAL dal = new DAL();
            List<String> names = dal.getFamMembers(userId);
            String res = "<ul>";
            foreach (String name in names)
            {
                res += "<li>" +name +"</li>";
            }
            res += "</ul>";
            return res;
        }

        public String getFstDeg()
        {
            int userId = Int32.Parse(Session["id"].ToString());
            DAL dal = new DAL();
            HashSet<String> names = dal.getNamesOfFDFr(userId);
            String res = "<ul>";
            foreach (String name in names)
            {

                res += "<li>" + name + "</li>";
            }
            res += "</ul>";
            return res;
        }

        public String getSndDeg()
        {
            int userId = Int32.Parse(Session["id"].ToString());
            String uname = Session["uname"].ToString();
            DAL dal = new DAL();
            List<String> names = dal.getNamesOfSDFr(userId);
            String res = "<ul>";
            foreach (String name in names)
            {
                if(name!=uname)
                    res += "<li>" + name + "</li>";
            }
            res += "</ul>";
            return res;
        }

        public String getTrdDeg()
        {
            int userId = Int32.Parse(Session["id"].ToString());
            String uname = Session["uname"].ToString();
            DAL dal = new DAL();
            List<String> names = dal.getNamesOfTRFr(userId);
            String res = "<ul>";
            foreach (String name in names)
            {
                if (name != uname)
                    res += "<li>" + name + "</li>";
            }
            res += "</ul>";
            return res;
        }

        public String deleteDujmani()
        {
            int dujid = Int32.Parse(Request.Params["dujman"]);
            DAL dal = new DAL();
            int userId = Int32.Parse(Session["id"].ToString());

            dal.deleteFriendship(dujid, userId);
            dal.deleteFriendship(userId, dujid);

            dal.deleteDujmani(dujid, Session["familyMembs"].ToString());

            return "yas";
        }
    }
}