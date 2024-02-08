<?php //require "../layouts/header.php" ?>
<?php //require "../../config/config.php"; ?>
<?php
//
//if(isset($_GET['id'])) {
//    $id = $_GET['id'];
//    $select = $conn->prepare("select * from categories where id = :id");
//    $select->execute([
//            ":id"=>$id,
//    ]);
//    $category = $select->fetch(PDO::FETCH_OBJ);
//
//    if(isset($_POST['submit'])) {
//        if(empty($_POST['name']) || empty($_POST['description'])) {
//            echo "<script>alert('one or more input is empty')</script>";
//        } else {
//            unlink("images/".$category->image."");
//
//            $name = $_POST['name'];
//            $description = $_POST['description'];
//            $image = $_FILES['image']['name'];
//
//            $dir = "images/" . basename($image);
//
//            $insert = $conn->prepare("update categories set name = :name, description = :description, image= :image where id = :id");
//            $insert->execute([
//                ":name" => $name,
//                ":description" => $description,
//                ":image" => $image,
//                ":id" => $id,
//            ]);
//
//            if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
//                header("location: ".ADMINURL."/categories-admins/show-categories.php");
//
//            }
//
//        }
//    }
//
//
//}
//
//
//
//?>


<?php
require "../layouts/header.php";
require "../../config/config.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = $conn->prepare("SELECT * FROM categories WHERE id = :id");
    $select->execute([
        ":id" => $id,
    ]);
    $category = $select->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])) {
        if(empty($_POST['name']) || empty($_POST['description'])) {
            echo "<script>alert('One or more input is empty')</script>";
        } else {
            $name = $_POST['name'];
            $description = $_POST['description'];

            // Check if a new image file is provided
            if(!empty($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
                $dir = "images/" . basename($image);
                unlink("images/" . $category->image); // Delete the old image

                // Move the uploaded image to the specified directory
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
                    // Update the database with the new image file name
                    $update = $conn->prepare("UPDATE categories SET name = :name, description = :description, image = :image WHERE id = :id");
                    $update->execute([
                        ":name" => $name,
                        ":description" => $description,
                        ":image" => $image,
                        ":id" => $id,
                    ]);
                } else {
                    echo "<script>alert('Failed to upload the image')</script>";
                }
            } else {
                // No new image provided, update only text fields
                $update = $conn->prepare("UPDATE categories SET name = :name, description = :description WHERE id = :id");
                $update->execute([
                    ":name" => $name,
                    ":description" => $description,
                    ":id" => $id,
                ]);
            }

            header("location: ".ADMINURL."/categories-admins/show-categories.php");
        }
    }
}

?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Categories</h5>
                <form method="POST" action="" enctype="multipart/form-data">
                    <!-- Email input -->
                    <div class="form-outline mb-4 mt-4">
                        <label for="exampleFormControlTextarea1">Name</label>

                        <input type="text" name="name" value="<?php echo $category->name;?>" id="form2Example1" class="form-control" placeholder="name" />

                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $category->description;?></textarea>
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <label>Image</label><br>
                        <img src="images/<?php echo $category->image; ?>" alt="img" width=200 height=200 />
                        <br>
                        <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
                    </div>


                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


                </form>

            </div>
        </div>
    </div>
</div>
<?php require "../layouts/footer.php" ?>
