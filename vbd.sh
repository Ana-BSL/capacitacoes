#!/bin/bash

 if [ $# -lt 1 ];
  then
   echo "Precisa fornecer pelo menos 1 argumento!  e - exportar;  i - importar"
   exit 1
 fi

user_name="pires"
bd_path="/opt/lampp/bin"
folder_default="/opt/lampp/htdocs/projetoModelo/common/bd"
file_name=$(date +%Y%m%d%H%M%S)"mysql_"$user_name".slq"
bd_name="projetoModelo"


cd $bd_path


if [ $1 == "e" ];
then
	echo "Deseja realmente exportar o banco de dados? s/n"
	read op
	if [ $op == "s" ];
	then
		./mysqldump -u root -p -B --events --routines --triggers $bd_name > $folder_default/$file_name -v
		if [ -e $folder_default/$file_name ] ; 
		then
			echo " "
			echo "O arquivo "$folder_default"/"$file_name" foi criado com sucesso."
		else
			echo "problema ao criar arquivo."
		fi
	else
 		echo "Operação cancelada."
	fi
elif [ $1 == "i" ];
then
        cd $folder_default
	ls  --color -1
	echo "Nome do arquivo"
	read -e nome
	echo "Deseja realmente importar o arquivo "$nome" para o banco de dados? s/n"
	read op
	if [ $op == "s" ];
	then
		cd $bd_path
		./mysqladmin -u root -p drop $bd_name -v
		./mysqladmin -u root -p create $bd_name -v
		./mysql -u root -p $bd_name < $folder_default/$nome -v

	elif [ $op == "n" ]
	then
		echo "Operação cancelada."
	fi
fi




