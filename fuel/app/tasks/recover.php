<?php

namespace Fuel\Tasks;

class Recover
{

	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r recover
	 *
	 * @return string
	 */
	public function run($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning DEFAULT task [Recover:Run]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
	}



	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r recover:index "arguments"
	 *
	 * @return string
	 */
	public function index($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning task [Recover:Index]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
     require_once("simple_html_dom.php");
     $html = file_get_html( 'Buys.html' );
     $nodes= $html->find("table");
     foreach($nodes as $node){
       $user=null;
       $username = $node->find(".username"); 
       if(isset($username[0])){
         var_dump($username[0]->text());
         $user = \Model_User::query()->where("name",$username[0]->text())->get_one();
         if(!$user){
           $user = new \Model_User();
           $user->username = $username[0]->text();
           $user->name = $username[0]->text();
           $user->save();
         }
       }
       $trs= $node->find("tr"); 
       foreach($trs as $key =>$tr){
         if($key>2){
           $td= $tr->find("td"); 
           if($user&&\Model_Buy::mb_strtotime("2014年10月".$td[0]->text())){
             $Buy = new \Model_Buy();
             $Buy->user_id = $user->id;
             $Buy->date = \Model_Buy::mb_strtotime("2014年10月".$td[0]->text());
             $Buy->content= $td[1]->text();
             $Buy->price= $td[2]->text();
             $Buy->save();
           }
           var_dump($key." ".$td[0]->text()." ".$td[1]->text()." ".$td[2]->text());
         }
       }
     }
     $html->clear();
     
	}

}
/* End of file tasks/recover.php */
