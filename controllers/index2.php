<!-- //Here is the Code For the Database Creation  -->

<?php



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
    // echo "the value of new sno is  $sno";
    // echo $sno;
     $delete=true;  
    $sql="DELETE  FROM  `StudentRecord` WHERE `sno`=$sno";
     $result=mysqli_query($conn,$sql);
    //  echo "the record has been deleted";
  }
 else
  if(isset($_GET['ids']))
  {
  
    $deleteall_id=$_GET['ids'];

  echo "the ids returned  by the client side javascript is ";
  echo  $deleteall_id;

//  if (is_array($deleteall_id));
// {
//   echo "the entered is array";
//   $extractall_ids=implode(',',$deleteall_id);
// }
//   $extractall_ids=implode(',',$deleteall_id);



$sql="DELETE  FROM  `StudentRecord` WHERE `sno` IN($deleteall_id)";


  $result=mysqli_query($conn,$sql);

 echo  "the record for multiselected items has been deleted"; 


  }



if($_SERVER['REQUEST_METHOD']=='POST')
{
  if (isset($_POST['snoEdit']))
  {

   $new= $_FILES['my_image_edit']['tmp_name'];
    
   echo $new;
  
    // ECHO "hello";
    // $oldsrc=$_POST["oldsrc"];
    // $sno=$_POST["snoEdit"];  
    // echo $oldsrc;
    // echo $sno;
   //  die();

    echo "the edit button is clicked";

      $sno=$_POST["snoEdit"];  
       $name=$_POST["NameEdit"];
       $email=$_POST["EmailEdit"];
       $coursecode=$_POST["CourseCodeEdit"];
       $password=$_POST["PasswordEdit"];
       $oldsrc=$_POST["oldsrc"];


       echo $oldsrc;

      
       if (isset($_FILES['my_image_edit']) && $_FILES['my_image_edit']['error'] ===UPLOAD_ERR_OK) {

        $img_name = $_FILES['my_image_edit']['name'];
        $img_size = $_FILES['my_image_edit']['size'];
        $tmp_name = $_FILES['my_image_edit']['tmp_name'];
        $error = $_FILES['my_image_edit']['error'];
    

      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
	 		$img_ex_lc = strtolower($img_ex);

	 		$allowed_exs = array("jpg", "jpeg", "png"); 

      echo "here the condtions to check whether the image is present or not  "; 
           
               
			if (in_array($img_ex_lc, $allowed_exs)) 
	 		{
        
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'dest/'.$new_img_name;
				
	 			echo ("here  is the code  to move the file");
   
	 			move_uploaded_file($tmp_name, $img_upload_path);
    
      
        // // Save $new_file_path in the database
        // (Insert code to save $new_file_path in your database)

        $sql="UPDATE `StudentRecord` SET `Name`='$name' ,`Email`='$email', CourseCode='$coursecode', `Password`='$password' , `Images`='$new_img_name'   WHERE `StudentRecord`.`sno`=$sno";
      

        mysqli_query($conn, $sql);
        header("Location: index2");
 

        echo "New file uploaded successfully!";
        // Unlink the existing file if it exists
      }
        $existing_file_path = $oldsrc; // Set to the URL of the existing file

        if (!empty($existing_file_path) && file_exists($existing_file_path)) {
            unlink($existing_file_path);
            echo "Existing file unlinked successfully!";
        }
    } 
    else 
    {
        // No new file was uploaded, retain the existing file path

        $existing_file_path = basename($oldsrc);
        
        // Set to the URL of the existing file
        
        // $existing_file_path = $existing_file_path ;

        // Save the existing file path in the database
        // (Insert code to save $existing_file_path in your database)

        $sql="UPDATE `StudentRecord` SET `Name`='$name' ,`Email`='$email', CourseCode='$coursecode', `Password`='$password' , `Images`='$existing_file_path'   WHERE `StudentRecord`.`sno`=$sno";
      

	 			mysqli_query($conn, $sql);
	 			header("Location: index2");
  
      
        echo "No new file uploaded. Existing file retained.";
        // Unlink the existing file if it exists

        if (!empty($existing_file_path) && file_exists($existing_file_path)) 
        {
            unlink($existing_file_path);
            echo "Existing file unlinked successfully!";
        }
    }







    //   $img_name = $_FILES['my_image_edit']['name'];
    //   $img_size = $_FILES['my_image_edit']['size'];
    //   $tmp_name = $_FILES['my_image_edit']['tmp_name'];
    //   $error = $_FILES['my_image_edit']['error'];
    
    //  echo $img_name;
    //  echo $img_size;
    //  echo $tmp_name;
    //  echo $error; 
    //   //   echo $sno;

      // echo $imagepath ;
      // $data = array();

      // Loop through each POST parameter and add it to the array
    
      // foreach ($_POST as $key => $value) 
      // {
      //     $data[$key] = $value;
      // }
      // echo "<pre>";
      // print_r($_FILES);
      // echo "</pre>";

      // echo  "here the die function starts";

 
// if(file_exists("dest/".$_FILES['image']['name']))
// {
// unlink("dest/.$old_image");
// $_SESSION['status']=$filename. "Image already exits ";
// header('location :index');
// }


  // if ($error === 0) 
	// {
    
  //   echo  "Here the die function starts";
    
    
	// 	if ($img_size > 125000) 
	// 	{
    
	// 		$em = "Sorry, your file is too large.";
	// 	    header("Location: index.php?error=$em");
	// 	}
	// 	else 
	// 	{
      
	// 		$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
	// 		$img_ex_lc = strtolower($img_ex);

	// 		$allowed_exs = array("jpg", "jpeg", "png"); 

  //           echo "here the condtions to check whether the image is present or not  "; 
           
               
	// 		if (in_array($img_ex_lc, $allowed_exs)) 
	// 		{
        
	// 			// Insert into Database
  //       $sql="UPDATE `StudentRecord` SET `Name`='$name' ,`Email`='$email', CourseCode='$coursecode', `Password`='$password' , `Images`='$new_img_name'   WHERE `StudentRecord`.`sno`=$sno";
      

  //      echo $sql;
       
  //      // echo $conn;

	// 			mysqli_query($conn, $sql);
	// 			header("Location: index2");
  
  //       echo "the Query is runned sucessfully";

	// 		}

	// 		else 
	// 		{
	// 			$em = "You can't upload files of this type";
	// 	        header("Location: index.php?error=$em");
	// 		}
	// 	}
	// }
	
	// else 
	// {
	// 	$em = "unknown error occurred!";
	// 	header("Location: index.php?error=$em");
	// }


 
      //   $sql="UPDATE `StudentRecord` SET `Name`='$name' ,`Email`='$email', CourseCode='$coursecode', `Password`='$password'  WHERE `StudentRecord`.`sno`=$sno";
      

      // $result = mysqli_query($conn, $sql);
      // if ($result)
      // { 
      //   echo $result;
      //   echo "the query is run sucessfully "; 
      //   $update=true;
      //   echo "record is Updated SucessFully";
      // }
      // else
      // {
      //   echo "We could not update the values";
      // }


   
  }
else if (isset($_POST['submit']) && isset($_FILES['my_image']['name'])) 
{

  echo "Here the Code  for the Adding the Record Starts";

  
  echo "<pre>";
	print_r($_FILES);
	echo "</pre>";

  echo "Till here the we preserve the componenets of file";
  
  $name=$_POST["name"];
  $email=$_POST["email"];
  $coursecode=$_POST["coursecode"];
  $password=$_POST["password"];

  $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];


  echo "here the file information is stored in the variables";
  

  echo  $img_name;
  echo  $img_size;
  echo $tmp_name;
  echo $error;
  echo $email;
  echo $coursecode;
  echo  $name;
   echo $password;


  echo "here we diplay the image inforamtion";


  if ($error === 0) 
	{
    
		if ($img_size > 125000) 
		{
    
			$em = "Sorry, your file is too large.";
		    header("Location: index.php?error=$em");
		}
		else 
		{
      
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

            echo "here the condtions to check whether the image is present or not  "; 
           
           
			if (in_array($img_ex_lc, $allowed_exs)) 
			{
        

				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'dest/'.$new_img_name;
				
				echo ("here  is the code  to move the file");

       

				move_uploaded_file($tmp_name, $img_upload_path);
    
				echo "the  function to  upload the file is runned sucessfully";



				// Insert into Database
        $sql="INSERT INTO `StudentRecord` ( `Name`, `Email` , `CourseCode`, `Password`,`Images` ) VALUES ( '$name', '$email', '$coursecode', '$password', '$new_img_name')";


				mysqli_query($conn, $sql);
				header("Location: index2");

       
			}

			else 
			{
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
		}
	}
	
	else 
	{
		$em = "unknown error occurred!";
		header("Location: index.php?error=$em");
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
       
      <form action="/Student/index2"  method="post" enctype="multipart/form-data">
 
         <input type="hidden" name="snoEdit" id="snoEdit"> 
 
 <!---- Here is the code which Will appear in the Popup  when we edit the Notes --->
         <div class="form-group">
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
 
              <div class='alb h-24 w-16 mb-6 object-cover'>
             <div class="h-24 w-16"  id="preview2">
              <img  id="destinationImage" src=""  class="max-h-full h-full"> 
              </div>
              <input type="hidden" id="oldsrc" name="oldsrc" >
            </div> 

                          
              <input type="file" name="my_image_edit" class="mt-2" id="imageInput2" >
              
          
            

<!-- 
            <input type="file" name="my_image_edit"> -->
       



        
         <button type="submit" class="btn btn-primary" id="saveChangesBtn"    >Save Changes</button>
   
       </div>
       
       
          


     </div>
     </form> 
   </div>
 </div>



<div class="maincontainer  w-full h-64 h-auto  ">

<!----------Here the code for the Navbar Starts--------->     

  <nav class="navbar navbar-expand-lg  bg-gray-500     ">  
    <div class="heading">
      <div class="noteslogo"><img  src="" rel="noteslogo" ></div>
    <a class="navbar-brand text-white font-bold  " href="#"> Student Portal 2</a>
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
  <strong>Success!</strong> Your Student Record has been inserted successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";

}

if($update)
{
  echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Student has been updated successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}

if($delete)
{
  echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Student Record has been Deleted successfully
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>";
}

?>

<!----------Here the Code for the Section Container Starts---------->

<div class="sectioncontainer  bg-[#091979] flex flex-col ">

    
<!----------Here is the Credentials Input Container ----------------------->
       
    <div class="inputcontainer  w-[80%]  flex flex-row  justify-center px-64   mt-4 ">

           <form action="/Student/index2"  method="post"  class="w-full flex flex-row" enctype="multipart/form-data" >

            <!-- here is the form left side container  -->

           <div class="leftformsection w-[60%]  border:none  flex flex-col    justify-center items-center   ">

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
            <button  name="submit" type="submit"  id="Add_changes" class="btn btn-primary  w-full h-full w-64 bg-gradient-to-r from-cyan-500 ">Add</button>
            </div>
           
              

        </div>


            
        <div  class=" h-16  mt-8  ml-8  bg-white-200  text-white-400 inline    w-36  "  >
              <div class="imagecontainer  w-28  h-32  mt-8 bg-gray-500 object-contain"  id="preview" > 
               <img src=""  > 
              </div>    
              <input type="file" name="my_image" class="mt-4" id="imageInput" >
               <input  type="hidden" name="old_image" value="<?php echo $row['Images'];?>" >
            </div>
       

        </form>


           </div>

             
          
          


       
<!--------------------- Here is the Table Container ---------------->


<div class="container mt-4 table_container  border-4 border-black bg-white pt-4  ">
<table class="table w-full" id=myTable>
  <thead>
    <tr>
      <th scope="col" class="tableheading">Select</th>
      <th scope="col" class="tableheading">S.No</th>
      <th scope="col" class="tableheading" >Name</th>
      <th scope="col"  class="tableheading">Email</th>
      <th scope="col"  class="tableheading" >CourseCode</th>
      <th scope="col"  class="tableheading" >Password</th>
      <th scope="col"  class="tableheading" >Actions</th>
      <th scope="col"  class="tableheading" >Image</th>    
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
 echo "<tr class='h-28'  >
 <td><label><input class='' type='checkbox' name='checkbox' id=".$row['sno']."> </label> </td> 
   <th scope='row'>". $sno ."</th>  
   <td>". $row['Name'] . "</td>
   <td>". $row['Email'] ."</td>
   <td>". $row['CourseCode'] . "</td>
   <td>". $row['Password']."</td> 
   
   <td>
   <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>
   <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>
   </td>
   <td><div class='alb  h-14 w-14'>
    <img id='myImage' src=dest/".$row['Images'].">
    </div>
      </td>


 </tr>";
}

?>
</tbody>
</table>

<div class="button m-4 w-44 h-12">
<button class="delete-all btn btn-sm btn-primary w-full h-full bold" id="deleteall" name="deleteall">Delete All</button>
</div>
</div>
</div>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19" rel="stylesheet">



<!--  
<script>    
  $(document).ready(function()
   {
   $('#myTable').DataTable();
   });

</script>    -->


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
    window.location=`/Student/index2?delete=${sno}`;
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

  Name=tr.getElementsByTagName("td")[1].innerText;
  Email=tr.getElementsByTagName("td")[2].innerText;
  CourseCode=tr.getElementsByTagName("td")[3].innerText;
  Password=tr.getElementsByTagName("td")[4].innerText;
  


  // var imageElement = document.getElementById("myImage"); 

  var imageUrl = tr.getElementsByTagName("td")[6].getElementsByTagName("img")[0].getAttribute("src");

   console.log(imageUrl);

  var destinationImage = document.getElementById("destinationImage");

  
  destinationImage.setAttribute("src",imageUrl);

    console.log(imageUrl); 
    
  
 
  console.log(Name,Email,CourseCode,Password);


  NameEdit.value=Name;
  EmailEdit.value=Email;
  CourseCodeEdit.value=CourseCode;
  PasswordEdit.value=Password;
 
  $("#oldsrc").val(imageUrl);


  snoEdit.value=e.target.id;
  console.log(e.target.id);

  console.log(snoEdit);
  $('#editModal').modal('toggle');


  })
  })





  //Here is the code for the deletion of the multi elements from the database....

console.log("Here we are learning how to delete multiple items");

 
let deleteAllButton = document.getElementById('deleteall');

deleteAllButton.addEventListener("click", (e) => {
    console.log("Delete all button is pressed");
    console.log("Button is pressed. Take this command and move forward.");
    
    getSelectedCheckboxIds();
    let selectedIds = getSelectedCheckboxIds();
    console.log("the selected ids in after return is ");
    console.log(selectedIds);
    //return;

    let queryString = selectedIds.length > 0 ? "ids=" + encodeURIComponent(selectedIds.join(',')) : "";
    
    
    window.location.href = "/Student/index2?" + queryString;

});


function getSelectedCheckboxIds() {
    let selectedIds = [];
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let atLeastOneChecked = false; 
    
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            atLeastOneChecked = true; 
            selectedIds.push(checkbox.id);
        }
    });
    
  
    if (!atLeastOneChecked) {
        alert("Please select at least one record to delete.");
        return;
    }
    
    // Log the selected IDs
    console.log("Selected Checkbox IDs:", selectedIds);
    //@returns {Array.<string>};
    return selectedIds;
}


// Here We Will Write the Javascript Code..........
// Assuming you have a button with id "saveChangesBtn"

// var destinationImage = document.getElementById('destinationImage');
// var existingImageUrl = destinationImage.src;

// // Check if existingImageUrl is a relative URL
// if (!existingImageUrl.startsWith('http') && !existingImageUrl.startsWith('/')) {
//     // Construct the absolute URL
//     var baseUrl = window.location.origin;
//     existingImageUrl = baseUrl + '/' + existingImageUrl;
// }

// console.log('Existing  absolute Image URL:', existingImageUrl);







console.log("Here we are learning to edit the images and we have to check why the image is going inside the  function to check why the component is not working ");

 var existingImageUrl = document.getElementById('destinationImage').src;
   
      console.log('Existing Image URL:', existingImageUrl);

      var saveChangesBtn = document.getElementById('saveChangesBtn');


    //   saveChangesBtn.addEventListener('click', function() {
    // console.log("Here the Function to save changes button starts ");

    // // Get the URL of the existing image displayed in the modal
    // var existingImageUrl = document.getElementById('destinationImage').src;

    // console.log('Existing Image URLin function is :', existingImageUrl);

    // Send the existing image URL to the server
//     fetch('index2.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({ existingImageUrl: existingImageUrl })
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('Network response was not ok.');
//         }
//         console.log('Image URL sent to server successfully.');
//     })
//     .catch(error => {
//         console.error('There was a problem with the fetch operation:', error);
//     });
// });


const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('max-w-full', 'max-h-64', 'mb-4');
                preview.innerHTML = ''; // Clear previous content
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = ''; // Clear previous content if no file selected
        }
    });



    
    const imageInput2 = document.getElementById('imageInput2');
    const previewb = document.getElementById('previewb');
    const destinationImage = document.getElementById('destinationImage');
    const oldsrc = document.getElementById('oldsrc');

    // Function to update the preview
    function updatePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            destinationImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    // Event listener for file input change
    imageInput2.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            updatePreview(file);
        } else {
            destinationImage.src = ''; // Clear the preview if no file is selected
        }
    });

    // Event listener for clicking on the photo
    destinationImage.addEventListener('click', function() {
        imageInput2.click(); // Trigger the file input click event
    });




















</script>


</body>
</html>