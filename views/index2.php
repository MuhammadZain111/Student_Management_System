<!-- //Here is the Code For the Database Creation  -->
<?php

// <!----------------  Here is the code to Establish the data ---------------

require 'functions.php';
echo "here";


function handleGetRequest($uri)
{ 
  switch ($uri) {
    case '/index2':
        echo 'Form submitted (POST)';
        break;
    default:
        echo '404 Not Found';
        break;
}
}

function handlePostRequest($uri)
{
  switch ($uri) {
    case '/index2':
        echo 'Form fetched (GET)';
        break;
    default:
        echo '404 Not Found';
        break;
}

  
}



$servername="localhost";
$username="root";
$password="";
$database="Student_Portal";


$insert=false;
$update=false;
$delete=false;


$conn=mysqli_connect($servername, $username, $password, $database);

if (!$conn) 
  {
  die ("Sorry We Failed to establish the Connnection" .mysqli_connect_error());
  }

  // Here is the Code to delete the record 

 if (isset($_GET['delete']))
  {
    $sno=$_GET['delete'];
    echo "the value of new sno is  $sno";
    echo $sno;
    $delete=true;  
    $sql="DELETE  FROM  `StudentRecord` WHERE `sno`=$sno";
     $result=mysqli_query($conn,$sql);
     echo "the record has been deleted";
  }

if($_SERVER['REQUEST_METHOD']=='POST')
{
  if (isset($_POST['snoEdit']))
  {
   
        $sno=$_POST["snoEdit"];
    
       $name=$_POST["NameEdit"];
       $email=$_POST["EmailEdit"];
       $coursecode=$_POST["CourseCodeEdit"];
       $password=$_POST["PasswordEdit"];

        echo $sno;
      

        $sql="UPDATE `StudentRecord` SET `Name`='$name' ,`Email`='$email', CourseCode='$coursecode', `Password`='$password' WHERE `StudentRecord`.`sno`=$sno";
      

      $result = mysqli_query($conn, $sql);
      if ($result)
      { 
        echo $result;
        echo "the query is run sucessfully "; 
        $update=true;
        echo "record is Updated SucessFully";
      }
      else
      {
        echo "We could not update the values";
      }
    }

else 
{
  $name=$_POST["name"];
  $email=$_POST["email"];
  $coursecode=$_POST["coursecode"];
  $password=$_POST["password"];

  // echo "Connection Was Sucessful <br>";

  $sql="INSERT INTO `StudentRecord` ( `Name`, `Email` , `CourseCode`, `Password`) VALUES ( '$name', '$email', '$coursecode', '$password' )";

  //  echo "dataa transfered";

  $result=mysqli_query($conn,$sql);
  
  // echo "Data is inserted SuccessFully";
  if($result)
   {
    $insert=true;
   }
   else
   {
   echo "The record is not inserted Successlly".mysqli_error($conn);
   }

 }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Student Design </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- DataTables JavaScript -->
    <script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>

     <!-- Tailwind CSS -->
     <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">

    <!--- Boostrap Javascript -->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">
     <!-----------   Tailwind CSS ----------->
     <script src="https://cdn.tailwindcss.com"></script>


</head>
<body >


<!-- Here the code for the Modal which Appears when the edit button is clicked -->


<div class="modal fade  bg-slate-200  " id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="editModalLabel">Edit The Record</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
 

 <div class="modal-body bg-gray-500">
       
       <form action="/Student/index2"  method="post">
 
         <input type="hidden" name="snoEdit" id="snoEdit"> 
 
 <!---- Here is the code which Will appear in the Popup  when we edit the Notes ----->
         <div class="form-group  ">
           <label for="title">Name</label>
           <input type="text" class="form-control" id="NameEdit" name="NameEdit" aria-describedby="emailHelp" placeholder="Enter Name">     
          </input>             
         </div>
        
         
         <div class="form-group">
             <label for="desc">Email</label>
             <input  type="text" class="form-control" id="EmailEdit" rows="3" name="EmailEdit"></input>
           </div> 
 
           <div class="form-group">
             <label for="desc">CourseCode</label>
             <input class="form-control" id="CourseCodeEdit" rows="3" name="CourseCodeEdit"></input>
           </div> 
 
           <div class="form-group">
             <label for="desc">Password</label>
             <input class="form-control" id="PasswordEdit" rows="3" name="PasswordEdit"></input>
           </div> 
 
           
         <button type="submit" class="btn btn-primary">Save Changes</button>
   
       </div>   
     </div>
     </form> 
   </div>
 </div>
 





<div class="maincontainer  w-full h-64 h-auto  bg-red-500 ">

<!----------Here the code for the Navbar Starts--------->     

  <nav class="navbar navbar-expand-lg  bg-gray-500     ">  
    <div class="heading">
      <div class="noteslogo"><img  src="" rel="noteslogo" ></div>
    <a class="navbar-brand text-white font-bold  " href="#"> Student Portal 2 </a>
    </div>

<!---Here is the code for the toogle button------->
  
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"
              >Home<span class="sr-only">(current)</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>


        <form class="form-inline my-2 my-lg-0">
          <input
            class="form-control mr-sm-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
            Search
          </button>
        </form>
      </div>
    </nav>


<?php

if($insert)
{
  echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been inserted successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";

}

if($update)
{
  echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been updated successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}

if($delete)
{
  echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been Deleted successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}

?>

<!----------Here the Code for the Section Container Starts---------->

<div class="sectioncontainer  bg-[#091979] flex flex-col ">

    
<!----------Here is the Credentials Input Container ----------------------->
       
    <div class="inputcontainer  w-[100%]  flex flex-col items-center justify-center px-24 ">





            <form action="/Student/index2"  method="post">

            <!-- <input type="hidden" name="snoEdit" id="snoEdit"> -->

              <div class="form-group">
                <label for="name" class="text-white">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter name" required   >
                </div>
          
                <div class="form-group">
                <label for="email"  class="text-white">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email"  required   >
              </div>

              <div class="form-group">
                <label for="coursecode" class="text-white">Course Code </label>
                <input type="text" class="form-control" id="coursecode" placeholder="Class Code"  name="coursecode"  required  >
              </div>

              <div class="form-group">
                <label for="password" class="text-white">Password</label>
                <input type="password" class="form-control" id="password" placeholder="password" name="password" required  >
              </div>
            
            <div class="button w-36 h-12 bg-red mt-4 ">
            <button type="submit" action="submit" id="Add_changes" class="btn btn-primary  w-full h-full  bg-gradient-to-r from-cyan-500">Add</button>
            </div>

            </form>
        </div>
    
<!--------------------- Here is the Table Container ---------------->


<div class="container mt-4 table_container  border-4 border-black bg-white pt-4  ">

<table class="table" id=myTable>
  <thead>
    <tr>
      <th scope="col" class="tableheading">S.No</th>
      <th scope="col" class="tableheading" >Name</th>
      <th scope="col"  class="tableheading">Email</th>
      <th scope="col"  class="tableheading" >CourseCode</th>
      <th scope="col"  class="tableheading" >Password</th>
      <th scope="col"  class="tableheading" >Actions</th>
    </tr>
  </thead>

<tbody>
</div>


<?php

$sql="SELECT * FROM `StudentRecord`";

$result=mysqli_query($conn,$sql);

$sno=0;

while($row=mysqli_fetch_assoc($result))
 {
  $sno=$sno+1;
 echo "<tr>
   <th scope='row'>". $sno ."</th>
   <td>". $row['Name'] . "</td>
   <td>". $row['Email'] ."</td>
   <td>". $row['CourseCode'] . "</td>
   <td>". $row['Password']."</td> 

   <td>
   <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>
   <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>
   </td>

 </tr>";
}
echo $sno;
?>

</tbody>
</table>



</div>


</div>


<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">




<script>    
  $(document).ready(function()
   {
   $('#myTable').DataTable();
   });
  
</script>   


<script>

// <!---------here is the code for the deleting the record ------------!>


deletes=document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
  element.addEventListener("click",(e)=>{
   console.log("delete",);
  sno=e.target.id.substring(1,);
  console.log("The value of sno is");
  console.log(sno);
  if(confirm("Are you sure you want to delete it? "))
  {
    console.log("yes");
    window.location=`/Student/index2.php?delete=${sno}`;
  }

 else
 {
  console.log("no");
 }

})
})



// here is the code for the edit option in which you can edit the student record 


edits=document.getElementsByClassName('edit');
  Array.from(edits).forEach((element)=>{
  element.addEventListener("click",(e)=>{
   console.log("edit",);
  tr=e.target.parentNode.parentNode;

  Name=tr.getElementsByTagName("td")[0].innerText;
  Email=tr.getElementsByTagName("td")[1].innerText;
  CourseCode=tr.getElementsByTagName("td")[2].innerText;
  Password=tr.getElementsByTagName("td")[3].innerText;
  
  console.log(Name,Email,CourseCode,Password);
  NameEdit.value=Name;
  EmailEdit.value=Email;
  CourseCodeEdit.value=CourseCode;
  PasswordEdit.value=Password;

  snoEdit.value=e.target.id;
  console.log(e.target.id);
  $('#editModal').modal('toggle');

  })
  })




</script>


</body>
</html>