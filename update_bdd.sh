user=""
password=""
dbname=""
while read line ; do
  case $( echo $line | cut -d"=" -f1) in
    "dbname") dbname=$( echo $line | cut -d"=" -f2);;
    "user") user=$( echo $line | cut -d"=" -f2);;
    "password") password=$( echo $line | cut -d"=" -f2)
  esac
done < ".env"

number=$( echo $(mysql -u $user -p$password $dbname -e "SELECT number FROM Version;") | cut -d" " -f2)

for eachfile in $(ls ./patch/*.sql)
do
  scriptNumber=$( echo $( echo $( echo $eachfile) | cut -d"/" -f3) | cut -d"_" -f1)
  if [ $scriptNumber -gt $number ]
  then
    echo $eachfile "+"
    if mysql -u $user -p$password $dbname < $eachfile;
    then
      echo $(mysql -u $user -p$password $dbname -e "UPDATE Version SET number="$scriptNumber" WHERE id=1;")
    else
      exit 1
    fi
  else
    echo $eachfile "="
  fi
done
