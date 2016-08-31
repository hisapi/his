if [ ! -d his ]
then
    echo
    echo "his folder does not exist"
    echo "run ./install-linux-his-server.sh before continuing"
    echo 
    exit 2
fi
if [ ! -f his-config.php ]
then
    echo
    echo "File his-config.php does not exist"
    echo "run ./install-linux-his-server.sh before continuing"
    echo 
    exit 2
fi
if [ ! -f launch_job_cluster.sh ]
then
    echo
    echo "File launch_job_cluster.sh does not exist"
    echo "run ./install-linux-his-server.sh before continuing"
    echo 
    exit 2
fi
if [ ! -f auth.xml ]
then
    echo
    echo "File auth.xml does not exist"
    echo "run ./install-linux-his-server.sh before continuing"
    echo 
    exit 2
fi
#if [ ! -d "serverbins-scripts" ]; then
#   echo "serverbins-scripts folder does not exist"
#   echo "run ./install-his-server.sh before continuing"
#   exit
#fi

cd his
forever=0
while [  $forever -lt 1 ]; do
    php index.php $1=$2
    sleep 1s
done
cd ..
