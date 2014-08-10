-- MySQL dump 10.13  Distrib 5.1.73, for unknown-linux-gnu (x86_64)
--
-- Host: localhost    Database: bios_lf
-- ------------------------------------------------------
-- Server version	5.1.73-cll

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wiki_pages`
--

DROP TABLE IF EXISTS `wiki_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wiki_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `alias` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki_pages`
--

LOCK TABLES `wiki_pages` WRITE;
/*!40000 ALTER TABLE `wiki_pages` DISABLE KEYS */;
INSERT INTO `wiki_pages` VALUES (1,0,'root','Littlefoot','<p>Download: <a href=\"http://littlefootcms.com/files/download/littlefoot.zip\">littlefoot.zip</a> (<a href=\"http://littlefootcms.com/files/download/littlefoot.tar.gz\">tar.gz</a>)</p>\r\n\r\n<p>LittlefootCMS was initially started with the sole purpose of making web development as easy as possible. It has evolved a great deal over the years and now makes website management easy as well. It is also very fast. With the right webserver configuration, you can see page execution times around 1ms. LittlefootCMS is released under the BSD License. This means that you can use it however you please, but must not remove the license, pretend you wrote it, or hold me liable for anything that comes from using it.</p>\r\n\r\n<h3>Installation</h3>\r\n\r\n<p>1. Download the .zip from [http://littlefootcms.com/files/download/littlefoot.zip]<br />\r\n2. Unzip contents into public_html<br />\r\n3. Visit http://yourdomain.com/littlefoot/<br />\r\n4. You will be prompted for database credentials, if you need to create a database in cPanel first, <a href=\"http://docs.cpanel.net/twiki/bin/view/AllDocumentation/CpanelDocs/MySQLDatabases\">follow these instructions</a><br />\r\n5. Once you enter all the database information, click Install, you will be redirected to the admin login form.<br />\r\n7. The default username and password is &ldquo;admin&rdquo; and &ldquo;pass&rdquo;. Log in to the admin section and customize this with the &quot;Users&quot; tool.</p>\r\n\r\n<h3>Using Littlefoot</h3>\r\n\r\n<p>After installation, visit the [[user]] and [[developer]] documentation</p>\r\n'),(2,0,'subwiki','subwiki','<p>my sub wiki</p>\r\n\r\n<p>[[evendeeper]]</p>\r\n'),(3,0,'developer','Developer Documentation','<p>Littlefoot is so much more than a CMS. It is a powerful framework with most of the tedious coding work already done. Writing web applications in littlefoot is actually really fun!</p>\r\n\r\n<p>[[App Development]]</p>\r\n\r\n<p>[[ORM]]</p>\r\n\r\n<p>[[testttt]]</p>\r\n\r\n<p>[[test2]]</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),(4,0,'ORM','ORM','<p>Here is an example of the orm extension used for the &#39;pages&#39; app</p>\r\n\r\n<div style=\"background:#eee; border:1px solid #ccc; padding:5px 10px\">\r\n<pre>\r\n<code>&lt;?php\r\n\r\nclass pages_orm extends orm\r\n{\r\n    public function all()\r\n    {\r\n        return orm::q(&#39;lf_pages&#39;)-&gt;cols(&#39;id, title&#39;)-&gt;order()-&gt;get();\r\n    }\r\n\r\n    public function getpage($id)\r\n    {\r\n        return orm::q(&#39;lf_pages&#39;)-&gt;filterByid($id)-&gt;first();\r\n    }\r\n\r\n    public function rmpage($id)\r\n    {\r\n        return orm::q(&#39;lf_pages&#39;)-&gt;filterByid($id)-&gt;delete();\r\n    }\r\n\r\n    public function savepage($id, $data)\r\n    {\r\n        $page = orm::q(&#39;lf_pages&#39;)-&gt;filterByid($id);\r\n        foreach($data as $col =&gt; $val)\r\n        {\r\n            $method = &quot;set$col&quot;;\r\n            $page-&gt;$method($val);\r\n        }\r\n        $page-&gt;save();\r\n    }\r\n\r\n    public function addpage($data)\r\n    {\r\n        $insert = orm::q(&#39;lf_pages&#39;)-&gt;add();\r\n        foreach($data as $col =&gt; $val)\r\n        {\r\n            $method = &quot;set$col&quot;;\r\n            $insert-&gt;$method($val);\r\n        }\r\n        return $insert-&gt;save();\r\n    }\r\n}</code></pre>\r\n</div>\r\n'),(5,0,'user','User Documentation','<p>Here is how you use the littlefoot admin/</p>\r\n\r\n<p>[[Dashboard]]</p>\r\n\r\n<p>[[Users Admin]]</p>\r\n\r\n<p>[[Skins Admin]]</p>\r\n\r\n<p>[[Settings]]</p>\r\n\r\n<p>[[ACL]] (advanced)</p>\r\n\r\n<p>&nbsp;</p>\r\n'),(6,0,'Settings','Settings','<p>Update to latest - 1click</p>\r\n'),(7,0,'Dashboard','Dashboard','<p>The littlefoot admin/ displays the dashboard by default. The dashboard consists of the Navigation system and the App Gallery.</p>\r\n\r\n<p>This is where you will control the apps linked to the publicly facing part of your website. The interface should hopefully be fairly intuitive.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>[[Bananas]]</p>\r\n'),(8,0,'Skins Admin','Skins Admin','<p>Editing a skin</p>\r\n\r\n<p>zipping a skin</p>\r\n'),(9,3,'App Development','App Development','<p>[[deeper]]</p>\r\n'),(10,3,'testttt','testttt','<p>dddd</p>\r\n'),(15,0,'asdf','asdf','<p>asdf</p>\r\n'),(16,7,'Bananas','Bananas','<p>asdf</p>\r\n'),(13,0,'asdf333','asdf434','<p>[[sample1]]</p>\r\n'),(17,9,'deeper','deeper','<p>[[asdf2]]</p>\r\n'),(18,0,'asdf2','asdf2',''),(19,3,'new','new','');
/*!40000 ALTER TABLE `wiki_pages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-10 15:57:48
