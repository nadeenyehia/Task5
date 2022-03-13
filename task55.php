<?php
// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     function Clean($input){
     
//         $input = trim($input);
//         $input = strip_tags($input);
//         $input = stripslashes($input);
 
//         return $input;
 
    
    
    
//     }
 
 
 
 if ($_SERVER['REQUEST_METHOD'] == "POST") {
 
     $title     = Clean($_POST['title']);
     $content    = Clean($_POST['content']);
     
     $errors = []; 
     
    
     if(empty($title)){
         $errors['Title'] = "Required Field ";
     }
     elseif(!filter_var($title,FILTRT_VALID_STRING)){
      echo  'title must be string';
     };
 
   
     if(empty($content)){
         $errors['content']  = "Required Field"; 
     }elseif(!(strlen($content)<50)){
         $errors['content']  = "content length must be >50"; 
     }

     if(count($errors) > 0 ){
        foreach ($errors as $key => $value) {
            
            echo '* '.$key.' : '.$value.'<br>';
        }
    }
 

    if (!empty($_FILES['image']['name'])) {

        $imgName    = $_FILES['image']['name'];
        $imgTemName = $_FILES['image']['tmp_name'];
        $imgType    = $_FILES['image']['type'];
        $imgSize    = $_FILES['image']['size'];

      
        $allowedExtensions = ['jpg', 'png'];

        $imgArray = explode('/', $imgType);

    
        $imageExtension = end($imgArray);


        if (in_array($imageExtension, $allowedExtensions)) {

          
            $FinalName = time() . rand() . '.' . $imageExtension;

            $disPath = 'uploads/' . $FinalName;


            if (move_uploaded_file($imgTemName, $disPath)) {
                echo 'Image Uploaded Succ ';
            } else {
                echo 'Error try Again';
            }
        } else {
            echo 'InValid Extension .... ';
        }
    } else {
        echo '* Image Required';
    }
}


include 'header.php';


?>


<body>

    <div class="container">
    <h2>Title</h2>

<form action="<?php echo  $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="exampleInputName">Title</label>
        <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="title" placeholder="Enter title">
    </div>
    <div class="form-group">
        <label for="exampleInputName">content</label>
        <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="content" placeholder="Enter content">
    </div>

        <h2>Upload File</h2>



            <div class="form-group">
                <label for="exampleInputName">Image</label>
                <input type="file" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" class="btn btn-primary">GO!!</button>
        </form>
    </div>