<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location:../");
    }
    
    $userdata = $_SESSION['userdata'];
    $partysdata = $_SESSION['partysdata'];
    
    if($_SESSION['userdata']['status']==0){
        $status = '<b style = "color:red">Not Voted</b>';
    }
    else{
        $status = '<b style = "color:green">Voted</b>';

    }
?>

<html>
    <head>
         <title>eVoting- Dashboard</title>
         <link rel = "stylesheet" href="../CSS/stylesheet.css">
    </head>
    <body>

         <style>
             #backbtn{
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: #44bd32;
                color: honeydew;
                float: left;
                margin: 10px;
             }

             #logoutbtn{
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: #44bd32;
                color: honeydew;
                float: right;
                margin: 10px;
             }

             #Profile{
                 background-color: white;
                 width: 30%;
                 padding: 20px;
                 float: left;
            }

            #Party{
                background-color: white;
                width: 60%;
                padding: 20px;
                float: right;

            }

            #votebtn{
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: #44bd32;
                color: honeydew;

            }

            #mainpanel{
                padding: 10px;
            }

            #voted{
                padding: 5px;
                font-size: 15px;
                border-radius: 5px;
                background-color: green;
                color: honeydew;

            }

            
         </style>

         <div id="mainSection">
             <center>
             <div id="headerSection">
                 <a href="../"><button id="backbtn">Back</button></a>
                 <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                 <h1>eVoting</h1>
             </div>
             </center>
             <hr>

             <div id="mainpanel">
                <div id="Profile">
                    <center><img src="../uploads/<?php echo $userdata['photo']?>" height="100" width="100"></center><br><br>
                    <b>Name:</b> <?php echo $userdata['name']?> <br><br>
                    <b>Mobile:</b> <?php echo $userdata['mobile']?> <br><br>
                    <b>Address:</b> <?php echo $userdata['address']?> <br><br>
                    <b>Status:</b> <?php echo $status?> <br><br>
                </div>
             <div id="Party">
                 <?php
                     if($_SESSION['partysdata']){
                         for($i=0; $i<count($partysdata); $i++){
                             ?>
                             <div>
                                 <img style="float: right" src="../uploads/<?php echo $partysdata[$i]['photo'] ?>" height="100" width="100">
                                 <b>Party Name: </b><?php echo $partysdata[$i]['name'] ?><br><br>
                                 <b>Votes: </b><?php echo $partysdata[$i]['votes'] ?><br><br>
                                 <form action="../API/vote.php" method="POST">
                                     <input type="hidden" name="pvotes" value="<?php echo $partysdata[$i]['votes']?>">
                                     <input type="hidden" name="pid" value="<?php echo $partysdata[$i]['id']?>">
                                     <?php
                                         if($_SESSION['userdata']['status']==0){
                                             ?>
                                             <input type="submit" name="votrbtn" value="Vote" id="votebtn">
                                             <?php
                                         }
                                         else{
                                             ?>
                                             <button type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                             <?php
                                            
                                         }
                                     
                                     ?>
                                   
                                    </form>
                             </div>
                             <hr>
                            <?php
                         }

                     }
                     else
                 ?>
             </div>

             </div>
             
         </div>
    </body>
</html>


