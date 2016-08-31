INSTALLING THE HIS JOB SERVER
----------------------------------

  To install the HIS Job Server on your computer, double-click:

    install-win-his-server.vbs

  If this is your first time opening this TAR file, you should follow
  the instructions on the HIS website.  This means if you are looking
  in general to install HIS, that you should
  
    ****INSTALL the HIS WEB INTERFACE first****.

  You should download & extract the HIS Web Interface into your www
  folder, and then navigate to your new folder on your browser:

    http://yourdomain.com/his/

  After you install the HIS WEB INTERFACE, under the
  "Add Windows Job Server" link in your HIS Web Interface, you will find
  instructions about how to create the following files manually:

    his-config.php
    launch_job_cluster.vbs
    auth.xml

  The HIS Web Interface provides you content to copy/paste into these
  files.  You will be unable to launch the Windows HIS Server Installer
  until these files are created.


  After the files above have been created, double-click the following 
  script found inside this folder.

     install-win-his-server.vbs

  This will launch the HIS Installer.  Some content will be downloaded
  into this folder using Wget.

  After the HIS Server installer completes, the script 

    launch_job_cluster.vbs

  will be launched automatically.

LAUNCHING YOUR JOB SERVER
----------------------------------

  launch_job_cluster.vbs

  is your primary execution script for starting the HIS Job Server.
  Double-click to run.

KILLING YOUR JOB SERVER INSTANCES
----------------------------------

  kill-win-his-server.vbs
  
  is the easiest way to stop all of your HIS Job Server threads at once.
  Double-click to run.

UPDATING YOUR JOB SERVER
----------------------------------

  update-linux-his-server.vbs
  
  is the easiest way to update your HIS Job Server.

