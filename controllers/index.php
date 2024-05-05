<!-- //Here is the Code For the Database Creation  -->
<?php

// <!----------------  Here is the code to Establish the data ---------------


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
  if (isset($_POST['Update']))
  {
   
    $sno=$_POST["edit"];
     
      echo $sno;

       $name=$_POST["name"];
       $email=$_POST["email"];
       $coursecode=$_POST["coursecode"];
       $password=$_POST["password"];

        echo $sno;
      
        $sql="UPDATE `StudentRecord` SET `Name`='$title' ,`Email`='$title', CourseCode='$coursecode', `Password`='$password' WHERE `sno`=$sno";
      


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

     <!-----------   Tailwind CSS ----------->
     <script src="https://cdn.tailwindcss.com"></script>


</head>
<body >

<div class="maincontainer  w-full h-64 h-auto  bg-red-500 ">

<!----------Here the code for the Navbar Starts--------->     

  <nav class="navbar navbar-expand-lg  bg-gray-500     ">  
    <div class="heading">
      <div class="noteslogo"><img  src="" rel="noteslogo" ></div>
    <a class="navbar-brand text-white font-bold  " href="#"> Student Portal </a>
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


    <!-- <div class="button">Add Student Details</div>
    <div class="button">Check Student Details</div>
    <div class="button">Delete Student Details</div>
    <div class="button">Update Student Details</div> -->



            <form action="/Student/index.php"  method="post">

            <input type="hidden" name="snoEdit" id="snoEdit">

              <div class="form-group">
                <label for="name" class="text-white">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter name" required   >
                </div>
          
                <div class="form-group">
                <label for="email"  class="text-white">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required >
              </div>

              <div class="form-group">
                <label for="coursecode" class="text-white">Course Code </label>
                <input type="text" class="form-control" id="coursecode" placeholder="Class Code"  name="coursecode" required   >
              </div>

              <div class="form-group">
                <label for="password" class="text-white">Password</label>
                <input type="password" class="form-control" id="password" placeholder="password" name="password" required  >
              </div>
            
            <div class="button">
            <button type="submit" action="submit" id="Add_changes" class="btn btn-primary">Add</button>
            </div>

            <div class="button">
            <button type="submit" action="submit" id="update_changes" class="btn btn-primary     " name="Update" >Update</button>
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
    window.location=`/Student/index.php?delete=${sno}`;
  }

 else
 {
  console.log("no");
 }

})
})



// here is the code for the edit option in which you can edit the student record 


document.addEventListener("DOMContentLoaded", function() {
 
   const edits = document.getElementsByClassName('edit');
   const nameInput = document.getElementById('name');
   const emailInput = document.getElementById('email');
   const coursecodeInput = document.getElementById('coursecode');
   const passwordInput = document.getElementById('password');
   const saveChangesButton = document.getElementById('update_changes');

       Array.from(edits).forEach((element) => {
       element.addEventListener("click", (e) => {
         const tr = e.target.parentNode.parentNode;

       const name = tr.getElementsByTagName("td")[0].innerText;
       const email = tr.getElementsByTagName("td")[1].innerText;
       const coursecode = tr.getElementsByTagName("td")[2].innerText;
       const password = tr.getElementsByTagName("td")[3].innerText;

       nameInput.value=name;
       emailInput.value =email;
       coursecodeInput.value =coursecode;
       passwordInput.value=password;

         saveChangesButton.style.display = 'block';
     });
     });



// here Will be the Code to save the changes  
  saveChangesButton.addEventListener("click", () => 
  {
  });


  // Add logic to save changes to the database

     const formData = new FormData();
     formData.append('name', nameInput.value);
     formData.append('email', emailInput.value);
     formData.append('coursecode', coursecodeInput.value);
     formData.append('password', passwordInput.value);

   fetch('index.php', {
       method: 'POST',
       body: formData
     })
     .then(response => {
    if (response.ok) {
         console.log("Changes saved successfully");
         saveChangesButton.style.display = 'none'; // Hide the button after saving changes
       } else {
         console.error("Failed to save changes");
       }
     })
   .catch(error => {
       console.error("Error:", error);
   });
   });

</script>


</body>
</html>